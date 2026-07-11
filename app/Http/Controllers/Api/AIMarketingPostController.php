<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreAIMarketingPostRequest;
use App\Jobs\TranslatePostLocalesJob;
use App\Models\Post;
use App\Services\PostAimarketingImageSync;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AIMarketingPostController extends Controller
{
    public function __invoke(StoreAIMarketingPostRequest $request): JsonResponse
    {
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

        $authorUserId = (int) config('services.aimarketing.author_user_id', 1);

        $viPost = DB::transaction(function () use (
            $data,
            $translationGroupId,
            $publishedAt,
            $status,
            $imageUrls,
            $authorUserId
        ): Post {
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

            // Featured/content images for the VI post only — keep this request fast.
            PostAimarketingImageSync::sync($viPost, $imageUrls);

            return $viPost->fresh();
        });

        // AI translation (en/zh) is slow; run after the HTTP response so clients do not hit cURL 28.
        TranslatePostLocalesJob::dispatch(
            $viPost->id,
            $authorUserId > 0 ? $authorUserId : 0,
            ['en', 'zh'],
            true,
            $imageUrls,
        )->afterCommit()->afterResponse();

        return response()->json([
            'url' => route('site.blog.show', ['slug' => $viPost->slug]),
            'translation_group_id' => $viPost->translation_group_id,
            'translation' => [
                'status' => 'queued',
                'reason' => null,
                'translated_locales' => [],
            ],
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
