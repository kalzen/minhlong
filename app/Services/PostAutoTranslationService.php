<?php

namespace App\Services;

use App\Ai\Agents\PostTranslationAgent;
use App\Models\Post;
use App\Models\UserAiApiKey;
use Illuminate\Support\Str;
use Laravel\Ai\Enums\Lab;

class PostAutoTranslationService
{
    /**
     * @var list<string>
     */
    private const SUPPORTED_LOCALES = ['en', 'vi', 'zh'];

    public function translatePostToMissingLocales(Post $sourcePost, int $userId): void
    {
        if ($sourcePost->translation_group_id === null) {
            return;
        }

        $apiKey = UserAiApiKey::query()
            ->where('user_id', $userId)
            ->where('is_active', true)
            ->orderByDesc('is_default')
            ->orderByDesc('id')
            ->first();

        if (! $apiKey instanceof UserAiApiKey) {
            return;
        }

        $existingLocales = Post::query()
            ->where('translation_group_id', $sourcePost->translation_group_id)
            ->pluck('locale')
            ->all();

        $targetLocales = collect(self::SUPPORTED_LOCALES)
            ->reject(fn (string $locale) => in_array($locale, $existingLocales, true))
            ->values();

        if ($targetLocales->isEmpty()) {
            return;
        }

        config([
            "ai.providers.{$apiKey->provider}.key" => $apiKey->api_key,
            'ai.default' => $apiKey->provider,
        ]);

        $provider = $this->labFromProvider($apiKey->provider);

        foreach ($targetLocales as $targetLocale) {
            $model = $apiKey->model ?: $this->defaultModelForProvider($apiKey->provider);
            $translated = (new PostTranslationAgent)->prompt(
                $this->buildPrompt($sourcePost, $targetLocale),
                model: $model,
                provider: $provider,
            );

            Post::query()->updateOrCreate(
                [
                    'translation_group_id' => $sourcePost->translation_group_id,
                    'locale' => $targetLocale,
                ],
                [
                    'category_id' => $sourcePost->category_id,
                    'title' => (string) ($translated['title'] ?? $sourcePost->title),
                    'slug' => $this->uniqueSlug((string) ($translated['title'] ?? $sourcePost->title), $targetLocale),
                    'excerpt' => $translated['excerpt'] ?? null,
                    'content' => $translated['content'] ?? null,
                    'status' => $sourcePost->status,
                    'published_at' => $sourcePost->published_at,
                    'meta_title' => $translated['meta_title'] ?? null,
                    'meta_description' => $translated['meta_description'] ?? null,
                    'created_by' => $sourcePost->created_by,
                ],
            );
        }
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
