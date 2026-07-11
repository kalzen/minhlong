<?php

namespace App\Jobs;

use App\Models\Post;
use App\Services\PostAimarketingImageSync;
use App\Services\PostAutoTranslationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class TranslatePostLocalesJob implements ShouldQueue
{
    use Queueable;

    public int $timeout = 300;

    public int $tries = 2;

    /**
     * @param  list<string>  $targetLocales  Empty = translate all missing locales.
     * @param  list<string>  $imageUrls
     */
    public function __construct(
        public int $postId,
        public int $userId,
        public array $targetLocales = [],
        public bool $publishTranslated = false,
        public array $imageUrls = [],
    ) {}

    public function handle(PostAutoTranslationService $postAutoTranslationService): void
    {
        $post = Post::query()->find($this->postId);

        if (! $post instanceof Post) {
            return;
        }

        $result = $this->targetLocales !== []
            ? $postAutoTranslationService->translatePostToLocales(
                $post,
                $this->userId,
                $this->targetLocales,
                $this->publishTranslated
            )
            : $postAutoTranslationService->translatePostToMissingLocales($post, $this->userId);

        if (($result['status'] ?? '') !== 'ok') {
            Log::warning('Post auto-translation skipped', [
                'post_id' => $post->id,
                'user_id' => $this->userId,
                'reason' => $result['reason'] ?? 'unknown',
            ]);
        }

        if ($this->imageUrls === [] || $post->translation_group_id === null) {
            return;
        }

        Post::query()
            ->where('translation_group_id', $post->translation_group_id)
            ->each(function (Post $localePost): void {
                PostAimarketingImageSync::sync($localePost, $this->imageUrls);
            });

        Post::query()
            ->where('translation_group_id', $post->translation_group_id)
            ->whereIn('locale', ['en', 'zh'])
            ->update([
                'category_id' => $post->category_id,
            ]);
    }
}
