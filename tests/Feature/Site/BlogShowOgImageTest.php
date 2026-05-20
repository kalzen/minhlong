<?php

use App\Models\Post;

test('blog post detail uses featured image for open graph and twitter image', function () {
    Post::query()->create([
        'category_id' => null,
        'translation_group_id' => null,
        'locale' => app()->getLocale(),
        'title' => 'OG Image Test',
        'slug' => 'og-image-test-slug',
        'excerpt' => 'e',
        'content' => '<p>c</p>',
        'thumbnail_path' => 'frontend/images/what-we-do-image.png',
        'status' => 'published',
        'published_at' => now(),
    ]);

    $response = $this->get(route('site.blog.show', ['slug' => 'og-image-test-slug']));

    $response->assertOk();
    $response->assertSee('property="og:image" content="', false);
    $response->assertSee('name="twitter:image" content="', false);
    $response->assertSee('what-we-do-image.png', false);
});
