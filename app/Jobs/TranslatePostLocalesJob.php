<?php

namespace App\Jobs;

use App\Models\Post;
use App\Services\PostAutoTranslationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class TranslatePostLocalesJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public int $postId,
        public int $userId,
    ) {}

    /**
     * Execute the job.
     */
    public function handle(PostAutoTranslationService $postAutoTranslationService): void
    {
        $post = Post::query()->find($this->postId);

        if (! $post instanceof Post) {
            return;
        }

        $postAutoTranslationService->translatePostToMissingLocales($post, $this->userId);
    }
}
