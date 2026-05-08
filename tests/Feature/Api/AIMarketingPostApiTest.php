<?php

use App\Models\Post;
use App\Services\PostAutoTranslationService;
use Illuminate\Support\Str;

test('aimarketing api rejects invalid token', function () {
    config(['services.aimarketing.api_token' => 'secret-token']);

    $this->postJson('/api/posts', [
        'title' => 'Bài test',
        'content' => '<p>Nội dung</p>',
    ])->assertUnauthorized();
});

test('aimarketing api creates vi post and auto creates en zh with shared thumbnail', function () {
    config(['services.aimarketing.api_token' => 'secret-token']);

    app()->bind(PostAutoTranslationService::class, function () {
        return new class extends PostAutoTranslationService
        {
            public function translatePostToLocales(
                Post $sourcePost,
                int $userId,
                array $targetLocales,
                bool $publishTranslated = false
            ): array {
                foreach ($targetLocales as $locale) {
                    Post::query()->create([
                        'category_id' => $sourcePost->category_id,
                        'translation_group_id' => $sourcePost->translation_group_id,
                        'locale' => $locale,
                        'title' => strtoupper($locale).' '.$sourcePost->title,
                        'slug' => Str::slug($locale.'-'.$sourcePost->title),
                        'excerpt' => $sourcePost->excerpt,
                        'content' => $sourcePost->content,
                        'status' => $publishTranslated ? 'published' : $sourcePost->status,
                        'published_at' => $publishTranslated ? now() : $sourcePost->published_at,
                        'meta_title' => $sourcePost->meta_title,
                        'meta_description' => $sourcePost->meta_description,
                    ]);
                }

                return [
                    'status' => 'ok',
                    'reason' => null,
                    'translated_locales' => $targetLocales,
                ];
            }
        };
    });

    $response = $this->withHeader('Authorization', 'Bearer secret-token')
        ->postJson('/api/posts', [
            'title' => 'Minh Long tự động đăng bài',
            'content' => '<p>Nội dung tiếng Việt</p>',
            'excerpt' => 'Mô tả ngắn',
            'thumbnail_path' => 'frontend/images/post-1.jpg',
            'status' => 'published',
        ])
        ->assertOk()
        ->assertJsonStructure([
            'url',
            'translation_group_id',
        ]);

    $groupId = $response->json('translation_group_id');

    $posts = Post::query()
        ->where('translation_group_id', $groupId)
        ->orderBy('locale')
        ->get();

    expect($posts)->toHaveCount(3);
    expect($posts->pluck('locale')->all())->toBe(['en', 'vi', 'zh']);
    expect($posts->pluck('thumbnail_path')->unique()->all())->toBe(['frontend/images/post-1.jpg']);
    expect($response->json('url'))->toContain('/blog/');
});
