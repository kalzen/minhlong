<?php

use App\Models\Post;
use App\Models\User;
use App\Services\PostAutoTranslationService;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

beforeEach(function () {
    User::factory()->create([
        'name' => 'Author One',
        'email' => 'author-one-aimarketing@example.test',
    ]);
});

test('aimarketing api rejects invalid token', function () {
    config(['services.aimarketing.api_token' => 'secret-token']);

    $this->postJson('/api/posts', [
        'title' => 'Bài test',
        'content' => '<p>Nội dung</p>',
    ])->assertUnauthorized();
});

test('aimarketing api validation failure returns json errors without accept header', function () {
    config(['services.aimarketing.api_token' => 'secret-token']);

    $this->withHeaders([
        'Authorization' => 'Bearer secret-token',
        'Accept' => 'text/html',
        'Content-Type' => 'application/json',
    ])
        ->call(
            'POST',
            '/api/posts',
            [],
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_ACCEPT' => 'text/html',
                'HTTP_AUTHORIZATION' => 'Bearer secret-token',
            ],
            json_encode([
                'title' => 'Chỉ có title, thiếu body/content',
                'description' => 'Mô tả',
            ], JSON_THROW_ON_ERROR)
        )
        ->assertUnprocessable()
        ->assertJsonStructure([
            'message',
            'errors' => ['content'],
        ]);
});

test('aimarketing api creates vi post and en zh translations', function () {
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
                        'thumbnail_path' => $sourcePost->thumbnail_path,
                        'status' => $publishTranslated ? 'published' : $sourcePost->status,
                        'published_at' => $publishTranslated ? now() : $sourcePost->published_at,
                        'meta_title' => $sourcePost->meta_title,
                        'meta_description' => $sourcePost->meta_description,
                        'created_by' => $sourcePost->created_by,
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
            'translation' => ['status', 'reason', 'translated_locales'],
        ]);

    $groupId = $response->json('translation_group_id');

    $posts = Post::query()
        ->where('translation_group_id', $groupId)
        ->orderBy('locale')
        ->get();

    expect($posts)->toHaveCount(3);
    expect($posts->pluck('locale')->all())->toBe(['en', 'vi', 'zh']);
    expect($posts->pluck('thumbnail_path')->unique()->all())->toBe(['frontend/images/post-1.jpg']);
    expect($posts->pluck('created_by')->unique()->all())->toBe([1]);
    expect($response->json('url'))->toContain('/blog/');
});

test('aimarketing api accepts body description faq image_urls payload', function () {
    config(['services.aimarketing.api_token' => 'secret-token']);

    $pngBody = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8z8BQDwAEhQGAhKmMIQAAAABJRU5ErkJggg==');

    Http::fake(function (Request $request) use ($pngBody) {
        if (str_contains($request->url(), 'cdn.example.com')) {
            return Http::response($pngBody, 200, ['Content-Type' => 'image/png']);
        }

        return Http::response('not found', 404);
    });

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
                        'thumbnail_path' => $sourcePost->thumbnail_path,
                        'status' => $publishTranslated ? 'published' : $sourcePost->status,
                        'published_at' => $publishTranslated ? now() : $sourcePost->published_at,
                        'meta_title' => $sourcePost->meta_title,
                        'meta_description' => $sourcePost->meta_description,
                        'created_by' => $sourcePost->created_by,
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
    expect($vi->created_by)->toBe(1);
    expect($vi->thumbnail_path)->toBeNull();
    expect($vi->getMedia('featured'))->not->toBeEmpty();
    expect($vi->excerpt)->toBe('Tóm tắt ngắn hiển thị meta description');
    expect($vi->meta_description)->toBe('Tóm tắt ngắn hiển thị meta description');
    expect($vi->content)->toContain('<p>Đoạn mở đầu...</p>');
    expect($vi->content)->toContain('post-faq');
    expect($vi->content)->toContain('SEO là gì?');
    expect($vi->content)->toContain('xếp hạng tốt hơn');
});
