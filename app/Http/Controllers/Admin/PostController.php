<?php

namespace App\Http\Controllers\Admin;

use App\Ai\Agents\PostSeoMetaAgent;
use App\Http\Controllers\Admin\Concerns\SyncsFeaturedFromEditorLibrary;
use App\Http\Controllers\Controller;
use App\Jobs\TranslatePostLocalesJob;
use App\Models\EditorMediaItem;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\UserAiApiKey;
use App\Services\PostAutoTranslationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;
use Laravel\Ai\Enums\Lab;
use Throwable;

class PostController extends Controller
{
    use SyncsFeaturedFromEditorLibrary;

    public function index(Request $request): Response
    {
        $posts = Post::query()
            ->with('category')
            ->when($request->string('locale')->toString(), fn ($q, $locale) => $q->where('locale', $locale))
            ->orderByRaw('CASE WHEN translation_group_id IS NULL THEN 1 ELSE 0 END')
            ->orderBy('translation_group_id')
            ->orderBy('locale')
            ->orderByDesc('updated_at')
            ->paginate(20)
            ->withQueryString();

        return Inertia::render('admin/Posts/Index', [
            'posts' => $posts,
            'filters' => [
                'locale' => $request->string('locale')->toString() ?: null,
            ],
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('admin/Posts/Edit', [
            'post' => null,
            'categories' => PostCategory::query()->orderBy('sort_order')->orderBy('name')->get(),
            'locales' => ['en', 'vi', 'zh'],
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request, null);
        if (empty($data['translation_group_id'])) {
            $data['translation_group_id'] = (string) Str::uuid();
        }
        $post = Post::query()->create($data + ['created_by' => $request->user()?->id]);

        $this->syncFeaturedFromEditorLibrary($request, $post);
        try {
            TranslatePostLocalesJob::dispatchSync($post->id, $request->user()->id);
        } catch (Throwable $throwable) {
            report($throwable);
        }

        return redirect()->route('admin.posts.edit', $post)->with('success', 'Post created.');
    }

    public function seoMetaSuggestion(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'locale' => ['required', 'string', 'max:8'],
        ]);

        $apiKey = UserAiApiKey::query()
            ->where('user_id', $request->user()->id)
            ->where('is_active', true)
            ->orderByDesc('is_default')
            ->orderByDesc('id')
            ->first();

        if (! $apiKey instanceof UserAiApiKey) {
            return response()->json([
                'message' => 'Chưa có AI API key hoạt động. Vui lòng thêm key ở Settings > AI API keys.',
            ], 422);
        }

        config([
            "ai.providers.{$apiKey->provider}.key" => $apiKey->api_key,
            'ai.default' => $apiKey->provider,
        ]);

        $provider = match ($apiKey->provider) {
            'openai' => Lab::OpenAI,
            'anthropic' => Lab::Anthropic,
            'gemini' => Lab::Gemini,
            'xai' => Lab::xAI,
            'deepseek' => Lab::DeepSeek,
            'groq' => Lab::Groq,
            'mistral' => Lab::Mistral,
            default => Lab::OpenAI,
        };

        $model = $apiKey->model ?: match ($apiKey->provider) {
            'openai' => 'gpt-5.4',
            'anthropic' => 'claude-haiku-4-5-20251001',
            'gemini' => 'gemini-2.5-flash',
            'xai' => 'grok-3-mini',
            'deepseek' => 'deepseek-chat',
            'groq' => 'llama-3.3-70b-versatile',
            'mistral' => 'mistral-small-latest',
            default => 'gpt-5.4',
        };

        try {
            $response = (new PostSeoMetaAgent)->prompt(
                <<<PROMPT
Generate SEO metadata for the following blog post.

Locale: {$validated['locale']}
Title: {$validated['title']}
Excerpt: {$validated['excerpt']}
Content (HTML):
{$validated['content']}
PROMPT,
                model: $model,
                provider: $provider,
            );
        } catch (Throwable $throwable) {
            report($throwable);

            return response()->json([
                'message' => 'Không thể tạo SEO bằng AI. Vui lòng thử lại.',
            ], 422);
        }

        return response()->json([
            'meta_title' => mb_substr((string) ($response['meta_title'] ?? ''), 0, 255),
            'meta_description' => mb_substr((string) ($response['meta_description'] ?? ''), 0, 255),
        ]);
    }

    public function translateLocale(
        Request $request,
        Post $post,
        PostAutoTranslationService $postAutoTranslationService
    ): RedirectResponse {
        $data = $request->validate([
            'locale' => ['required', 'string', Rule::in(['en', 'vi', 'zh'])],
        ]);

        if ($post->translation_group_id === null) {
            $post->update([
                'translation_group_id' => (string) Str::uuid(),
            ]);
        }

        $result = $postAutoTranslationService->translatePostToLocales(
            $post->fresh(),
            (int) $request->user()->id,
            [$data['locale']],
        );

        if (($result['status'] ?? '') !== 'ok' || ($result['translated_locales'] ?? []) === []) {
            return back()->with('error', 'Không thể tạo bản dịch. Vui lòng kiểm tra AI API key hoặc thử lại.');
        }

        return back()->with('success', 'Đã tạo bản dịch '.$data['locale'].'.');
    }

    public function edit(Post $post): Response
    {
        $post->load('category');

        return Inertia::render('admin/Posts/Edit', [
            'post' => [
                'id' => $post->id,
                'category_id' => $post->category_id,
                'translation_group_id' => $post->translation_group_id,
                'locale' => $post->locale,
                'title' => $post->title,
                'slug' => $post->slug,
                'excerpt' => $post->excerpt,
                'content' => $post->content,
                'status' => $post->status,
                'published_at' => $post->published_at?->format('Y-m-d\TH:i'),
                'meta_title' => $post->meta_title,
                'meta_description' => $post->meta_description,
                'featured_url' => $post->getFirstMediaUrl('featured') ?: null,
            ],
            'categories' => PostCategory::query()->orderBy('sort_order')->orderBy('name')->get(),
            'locales' => ['en', 'vi', 'zh'],
        ]);
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        $data = $this->validated($request, $post);
        $post->update($data);

        $this->syncFeaturedFromEditorLibrary($request, $post);

        return redirect()->route('admin.posts.edit', $post)->with('success', 'Post updated.');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Post deleted.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request, ?Post $post): array
    {
        $validated = $request->validate([
            'category_id' => ['nullable', 'exists:post_categories,id'],
            'translation_group_id' => ['nullable', 'uuid'],
            'locale' => ['required', 'string', 'max:8'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('posts', 'slug')
                    ->where(fn ($query) => $query->where('locale', $request->input('locale')))
                    ->ignore($post?->id),
            ],
            'excerpt' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'status' => ['required', 'in:draft,published'],
            'published_at' => ['nullable', 'date'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:255'],
            'featured' => ['nullable', 'file', 'image', 'max:10240'],
            'featured_library_media_id' => [
                'nullable',
                'integer',
                Rule::exists('media', 'id')->where(
                    fn ($q) => $q->where('model_type', EditorMediaItem::class)->where('collection_name', 'image')
                ),
            ],
        ]);

        unset($validated['featured'], $validated['featured_library_media_id']);

        if (($validated['translation_group_id'] ?? '') === '') {
            $validated['translation_group_id'] = null;
        }

        if (is_string($validated['meta_title'] ?? null)) {
            $validated['meta_title'] = mb_substr($validated['meta_title'], 0, 255);
        }

        if (is_string($validated['meta_description'] ?? null)) {
            $validated['meta_description'] = mb_substr($validated['meta_description'], 0, 255);
        }

        return $validated;
    }
}
