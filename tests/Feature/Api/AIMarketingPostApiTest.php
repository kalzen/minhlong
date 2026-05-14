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

test('aimarketing api accepts body description faq image_urls payload', function () {
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

    $thumbUrl = 'https://cdn.example.com/uploads/anh-1.jpg';

    $response = $this->withHeader('Authorization', 'Bearer secret-token')
        ->postJson('/api/posts', [
            'title' => '10 cách tối ưu SEO cho website bán hàng',
            'body' => '<p>Đoạn mở đầu...</p><h2>Mục 1</h2><p>Nội dung...</p>',
            'description' => 'Tóm tắt ngắn hiển thị meta description',
            'faq' => [
                ['question' => 'SEO là gì?', 'answer' => 'SEO là tối ưu để xếp hạng tốt hơn trên công cụ tìm kiếm.'],
            ],
            'image_urls' => [
                $thumbUrl,
                'https://cdn.example.com/uploads/anh-2.jpg',
            ],
            'status' => 'published',
        ])
        ->assertOk();

    $groupId = $response->json('translation_group_id');
    $vi = Post::query()->where('translation_group_id', $groupId)->where('locale', 'vi')->first();

    expect($vi)->not->toBeNull();
    expect($vi->thumbnail_path)->toBe($thumbUrl);
    expect($vi->excerpt)->toBe('Tóm tắt ngắn hiển thị meta description');
    expect($vi->meta_description)->toBe('Tóm tắt ngắn hiển thị meta description');
    expect($vi->content)->toContain('<p>Đoạn mở đầu...</p>');
    expect($vi->content)->toContain('post-faq');
    expect($vi->content)->toContain('SEO là gì?');
    expect($vi->content)->toContain('xếp hạng tốt hơn');
});
