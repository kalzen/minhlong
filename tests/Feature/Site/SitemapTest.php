<?php

use App\Models\Post;
use Illuminate\Support\Str;

beforeEach(function () {
    $this->sitemapPath = public_path('sitemap.xml');

    if (is_file($this->sitemapPath)) {
        unlink($this->sitemapPath);
    }
});

afterEach(function () {
    if (is_file($this->sitemapPath)) {
        unlink($this->sitemapPath);
    }
});

test('sitemap generate command writes public xml with static and blog urls', function () {
    Post::query()->create([
        'category_id' => null,
        'translation_group_id' => (string) Str::uuid(),
        'locale' => 'vi',
        'title' => 'Bài viết sitemap',
        'slug' => 'bai-viet-sitemap',
        'excerpt' => 'e',
        'content' => '<p>c</p>',
        'status' => 'published',
        'published_at' => now(),
    ]);

    $this->artisan('sitemap:generate')->assertSuccessful();

    expect(is_file($this->sitemapPath))->toBeTrue();

    $xml = file_get_contents($this->sitemapPath);

    expect($xml)->toContain('<urlset');
    expect($xml)->toContain(route('home'));
    expect($xml)->toContain(route('site.blog.index'));
    expect($xml)->toContain(route('site.blog.show', ['slug' => 'bai-viet-sitemap']));
});

test('sitemap route serves generated xml', function () {
    $this->artisan('sitemap:generate')->assertSuccessful();

    $this->get(route('site.sitemap'))
        ->assertOk()
        ->assertHeader('content-type', 'application/xml; charset=UTF-8');

    expect(file_get_contents($this->sitemapPath))
        ->toContain('<urlset')
        ->toContain(route('home'));
});

test('robots txt references sitemap url', function () {
    $this->get(route('site.robots'))
        ->assertOk()
        ->assertHeader('content-type', 'text/plain; charset=UTF-8')
        ->assertSee('Sitemap: '.url('/sitemap.xml'), false)
        ->assertSee('Disallow: /admin', false);
});

test('published blog post includes hreflang alternates in sitemap', function () {
    $group = (string) Str::uuid();

    Post::query()->create([
        'category_id' => null,
        'translation_group_id' => $group,
        'locale' => 'en',
        'title' => 'English post',
        'slug' => 'english-sitemap-post',
        'excerpt' => 'e',
        'content' => '<p>c</p>',
        'status' => 'published',
        'published_at' => now(),
    ]);

    Post::query()->create([
        'category_id' => null,
        'translation_group_id' => $group,
        'locale' => 'vi',
        'title' => 'Bài viết tiếng Việt',
        'slug' => 'bai-viet-sitemap-post',
        'excerpt' => 'e',
        'content' => '<p>c</p>',
        'status' => 'published',
        'published_at' => now(),
    ]);

    $this->artisan('sitemap:generate')->assertSuccessful();

    $xml = file_get_contents($this->sitemapPath);

    expect($xml)->toContain('hreflang="vi"');
    expect($xml)->toContain(route('site.blog.show', ['slug' => 'bai-viet-sitemap-post']));
    expect($xml)->toContain('hreflang="en"');
    expect($xml)->toContain(route('site.blog.show', ['slug' => 'english-sitemap-post']));
});
