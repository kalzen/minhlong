<?php

namespace App\Services;

use App\Ai\Agents\PostTranslationAgent;
use App\Models\Post;
use App\Models\UserAiApiKey;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Ai\Enums\Lab;

class PostAutoTranslationService
{
    /**
     * @var list<string>
     */
    private const SUPPORTED_LOCALES = ['en', 'vi', 'zh'];

    /**
     * @return array{status: string, reason: string|null, translated_locales: list<string>}
     */
    public function translatePostToMissingLocales(Post $sourcePost, int $userId): array
    {
        if ($sourcePost->translation_group_id === null) {
            return [
                'status' => 'skipped',
                'reason' => 'missing_translation_group',
                'translated_locales' => [],
            ];
        }

        $apiKey = UserAiApiKey::query()
            ->where('user_id', $userId)
            ->where('is_active', true)
            ->orderByDesc('is_default')
            ->orderByDesc('id')
            ->first();

        $existingLocales = Post::query()
            ->where('translation_group_id', $sourcePost->translation_group_id)
            ->pluck('locale')
            ->all();

        $targetLocales = collect(self::SUPPORTED_LOCALES)
            ->reject(fn (string $locale) => in_array($locale, $existingLocales, true))
            ->values();

        if ($targetLocales->isEmpty()) {
            return [
                'status' => 'skipped',
                'reason' => 'no_missing_locales',
                'translated_locales' => [],
            ];
        }

        return $this->translatePostToLocales($sourcePost, $userId, $targetLocales->all());
    }

    /**
     * @param  list<string>  $targetLocales
     * @return array{status: string, reason: string|null, translated_locales: list<string>}
     */
    public function translatePostToLocales(Post $sourcePost, int $userId, array $targetLocales): array
    {
        $targetLocales = collect($targetLocales)
            ->filter(fn (string $locale) => in_array($locale, self::SUPPORTED_LOCALES, true))
            ->reject(fn (string $locale) => $locale === $sourcePost->locale)
            ->values()
            ->all();

        if ($targetLocales === []) {
            return [
                'status' => 'skipped',
                'reason' => 'no_target_locales',
                'translated_locales' => [],
            ];
        }

        $apiKey = UserAiApiKey::query()
            ->where('user_id', $userId)
            ->where('is_active', true)
            ->orderByDesc('is_default')
            ->orderByDesc('id')
            ->first();

        $providerName = $apiKey?->provider ?? (string) config('ai.default', 'openai');
        $provider = $this->labFromProvider($providerName);
        $model = $apiKey?->model ?: $this->defaultModelForProvider($providerName);

        if ($apiKey instanceof UserAiApiKey) {
            config([
                "ai.providers.{$providerName}.key" => $apiKey->api_key,
                'ai.default' => $providerName,
            ]);
        }

        $providerKey = config("ai.providers.{$providerName}.key");
        if (! is_string($providerKey) || trim($providerKey) === '') {
            return [
                'status' => 'skipped',
                'reason' => 'missing_provider_key',
                'translated_locales' => [],
            ];
        }

        $translatedLocales = [];

        foreach ($targetLocales as $targetLocale) {
            $alreadyExists = Post::query()
                ->where('translation_group_id', $sourcePost->translation_group_id)
                ->where('locale', $targetLocale)
                ->exists();

            if ($alreadyExists) {
                continue;
            }

            $translated = (new PostTranslationAgent)->prompt(
                $this->buildPrompt($sourcePost, $targetLocale),
                model: $model,
                provider: $provider,
            );

            Post::query()->create([
                'category_id' => $sourcePost->category_id,
                'translation_group_id' => $sourcePost->translation_group_id,
                'locale' => $targetLocale,
                'title' => (string) ($translated['title'] ?? $sourcePost->title),
                'slug' => $this->uniqueSlug((string) ($translated['title'] ?? $sourcePost->title), $targetLocale),
                'excerpt' => $translated['excerpt'] ?? null,
                'content' => $translated['content'] ?? null,
                'status' => $sourcePost->status,
                'published_at' => $sourcePost->published_at,
                'meta_title' => is_string($translated['meta_title'] ?? null)
                    ? mb_substr($translated['meta_title'], 0, 255)
                    : null,
                'meta_description' => is_string($translated['meta_description'] ?? null)
                    ? mb_substr($translated['meta_description'], 0, 255)
                    : null,
                'created_by' => $sourcePost->created_by,
            ]);

            $translatedLocales[] = $targetLocale;
        }

        Log::info('Post auto-translation completed', [
            'post_id' => $sourcePost->id,
            'translation_group_id' => $sourcePost->translation_group_id,
            'provider' => $providerName,
            'translated_locales' => $translatedLocales,
        ]);

        return [
            'status' => 'ok',
            'reason' => null,
            'translated_locales' => $translatedLocales,
        ];
    }

    private function uniqueSlug(string $title, string $locale): string
    {
        $baseSlug = Str::slug($title);
        if ($baseSlug === '') {
            $baseSlug = 'post';
        }
        $candidate = $baseSlug;
        $counter = 1;

        while (Post::query()->where('locale', $locale)->where('slug', $candidate)->exists()) {
            $candidate = $baseSlug.'-'.$counter;
            $counter++;
        }

        return $candidate;
    }

    private function buildPrompt(Post $sourcePost, string $targetLocale): string
    {
        return <<<PROMPT
Translate this blog post to locale "{$targetLocale}".
Keep meaning and writing tone suitable for business readers.

SOURCE LOCALE: {$sourcePost->locale}
TITLE: {$sourcePost->title}
EXCERPT:
{$sourcePost->excerpt}

CONTENT HTML:
{$sourcePost->content}

META TITLE:
{$sourcePost->meta_title}

META DESCRIPTION:
{$sourcePost->meta_description}
PROMPT;
    }

    private function labFromProvider(string $provider): Lab
    {
        return match ($provider) {
            'openai' => Lab::OpenAI,
            'anthropic' => Lab::Anthropic,
            'gemini' => Lab::Gemini,
            'xai' => Lab::xAI,
            'deepseek' => Lab::DeepSeek,
            'groq' => Lab::Groq,
            'mistral' => Lab::Mistral,
            default => Lab::OpenAI,
        };
    }

    private function defaultModelForProvider(string $provider): string
    {
        return match ($provider) {
            'openai' => 'gpt-5.4',
            'anthropic' => 'claude-haiku-4-5-20251001',
            'gemini' => 'gemini-2.5-flash',
            'xai' => 'grok-3-mini',
            'deepseek' => 'deepseek-chat',
            'groq' => 'llama-3.3-70b-versatile',
            'mistral' => 'mistral-small-latest',
            default => 'gpt-5.4',
        };
    }
}
