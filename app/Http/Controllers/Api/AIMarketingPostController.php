<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreAIMarketingPostRequest;
use App\Models\Post;
use App\Services\PostAimarketingImageSync;
use App\Services\PostAutoTranslationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AIMarketingPostController extends Controller
{
    public function __invoke(
        StoreAIMarketingPostRequest $request,
        PostAutoTranslationService $postAutoTranslationService
    ): JsonResponse {
        $data = $request->validated();
        $translationGroupId = (string) Str::uuid();
        $publishedAt = isset($data['published_at']) ? Carbon::parse($data['published_at']) : now();
        $status = (string) ($data['status'] ?? 'published');

        $imageUrls = [];
        if (isset($data['image_urls']) && is_array($data['image_urls'])) {
            $imageUrls = array_values(array_filter(
                $data['image_urls'],
                static fn ($u): bool => is_string($u) && trim($u) !== ''
            ));
        }

        $translationPayload = [
            'status' => 'skipped',
            'reason' => null,
            'translated_locales' => [],
        ];

        $viPost = DB::transaction(function () use (
            $data,
            $translationGroupId,
            $publishedAt,
            $status,
            $postAutoTranslationService,
            $imageUrls,
            &$translationPayload
        ): Post {
            $authorUserId = (int) config('services.aimarketing.author_user_id', 1);

            $viPost = Post::query()->create([
                'category_id' => $data['category_id'] ?? null,
                'translation_group_id' => $translationGroupId,
                'locale' => 'vi',
                'title' => $data['title'],
                'slug' => $this->resolveUniqueSlug((string) ($data['slug'] ?? ''), (string) $data['title'], 'vi'),
                'excerpt' => $data['excerpt'] ?? null,
                'content' => $data['content'],
                'thumbnail_path' => $data['thumbnail_path'] ?? null,
                'status' => $status,
                'published_at' => $status === 'published' ? $publishedAt : null,
                'meta_title' => $data['meta_title'] ?? null,
                'meta_description' => $data['meta_description'] ?? null,
                'created_by' => $authorUserId > 0 ? $authorUserId : null,
            ]);

            PostAimarketingImageSync::sync($viPost, $imageUrls);

            $translationPayload = $postAutoTranslationService->translatePostToLocales(
                $viPost->fresh(),
                0,
                ['en', 'zh'],
                true
            );

            Post::query()
                ->where('translation_group_id', $translationGroupId)
                ->each(function (Post $post) use ($imageUrls): void {
                    PostAimarketingImageSync::sync($post, $imageUrls);
                });

            Post::query()
                ->where('translation_group_id', $translationGroupId)
                ->whereIn('locale', ['en', 'zh'])
                ->update([
                    'category_id' => $viPost->category_id,
                ]);

            return $viPost->fresh();
        });

        return response()->json([
            'url' => route('site.blog.show', ['slug' => $viPost->slug]),
            'translation_group_id' => $viPost->translation_group_id,
            'translation' => $translationPayload,
        ]);
    }

    private function resolveUniqueSlug(string $requestedSlug, string $title, string $locale): string
    {
        $base = Str::slug($requestedSlug !== '' ? $requestedSlug : $title);
        if ($base === '') {
            $base = 'post';
        }

        if (strlen($base) > 180) {
            $base = rtrim(substr($base, 0, 180), '-');
            if ($base === '') {
                $base = 'post';
            }
        }

        $candidate = $base;
        $counter = 1;

        while (Post::query()->where('locale', $locale)->where('slug', $candidate)->exists()) {
            $suffix = '-'.$counter;
            $candidate = substr($base, 0, max(1, 191 - strlen($suffix))).$suffix;
            $counter++;
        }

        return $candidate;
    }
}
