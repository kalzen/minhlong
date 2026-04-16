<?php

use App\Models\Post;
use Illuminate\Support\Str;

test('blog show redirects to localized sibling when slug is for another locale', function () {
    $group = (string) Str::uuid();

    Post::query()->create([
        'category_id' => null,
        'translation_group_id' => $group,
        'locale' => 'en',
        'title' => 'English title',
        'slug' => 'english-only-slug',
        'excerpt' => 'x',
        'content' => '<p>x</p>',
        'status' => 'published',
        'published_at' => now(),
    ]);

    Post::query()->create([
        'category_id' => null,
        'translation_group_id' => $group,
        'locale' => 'vi',
        'title' => 'Tiêu đề',
        'slug' => 'tieu-de-vi',
        'excerpt' => 'y',
        'content' => '<p>y</p>',
        'status' => 'published',
        'published_at' => now(),
    ]);

    expect(Post::query()->count())->toBe(2);

    $enPost = Post::query()->where('slug', 'english-only-slug')->where('locale', 'en')->first();
    expect($enPost)->not->toBeNull();
    $viSibling = Post::query()
        ->where('status', 'published')
        ->where('locale', 'vi')
        ->where('translation_group_id', $enPost->translation_group_id)
        ->first();
    expect($viSibling)->not->toBeNull();
    expect($viSibling->slug)->toBe('tieu-de-vi');

    $this->withSession(['locale' => 'vi'])
        ->get(route('site.blog.show', ['slug' => 'english-only-slug']))
        ->assertRedirect(route('site.blog.show', ['slug' => 'tieu-de-vi']));
});

test('home lists only posts for session locale', function () {
    Post::query()->create([
        'category_id' => null,
        'translation_group_id' => (string) Str::uuid(),
        'locale' => 'en',
        'title' => 'En only home',
        'slug' => 'en-only-home',
        'status' => 'published',
        'published_at' => now(),
    ]);

    Post::query()->create([
        'category_id' => null,
        'translation_group_id' => (string) Str::uuid(),
        'locale' => 'vi',
        'title' => 'Vi only home',
        'slug' => 'vi-only-home',
        'status' => 'published',
        'published_at' => now(),
    ]);

    $this->withSession(['locale' => 'vi'])
        ->get(route('home'))
        ->assertOk()
        ->assertSee('Vi only home', false)
        ->assertDontSee('En only home', false)
        ->assertSee(route('site.blog.show', ['slug' => 'vi-only-home']), false);
});

test('home blog placeholder when no posts for locale links to blog index', function () {
    Post::query()->create([
        'category_id' => null,
        'translation_group_id' => (string) Str::uuid(),
        'locale' => 'en',
        'title' => 'English only',
        'slug' => 'english-only-placeholder',
        'excerpt' => 'x',
        'content' => '<p>x</p>',
        'status' => 'published',
        'published_at' => now(),
    ]);

    $this->withSession(['locale' => 'vi'])
        ->get(route('home'))
        ->assertOk()
        ->assertSee(route('site.blog.index'), false)
        ->assertDontSee('english-only-placeholder', false);
});

test('home orders locale posts by newest translation group activity', function () {
    $groupRecentlyUpdatedByEn = (string) Str::uuid();
    $groupRecentViOnly = (string) Str::uuid();

    Post::query()->create([
        'category_id' => null,
        'translation_group_id' => $groupRecentlyUpdatedByEn,
        'locale' => 'vi',
        'title' => 'VI from group A',
        'slug' => 'vi-group-a',
        'status' => 'published',
        'published_at' => now()->subDays(7),
    ]);
    Post::query()->create([
        'category_id' => null,
        'translation_group_id' => $groupRecentlyUpdatedByEn,
        'locale' => 'en',
        'title' => 'EN from group A',
        'slug' => 'en-group-a',
        'status' => 'published',
        'published_at' => now(),
    ]);

    Post::query()->create([
        'category_id' => null,
        'translation_group_id' => $groupRecentViOnly,
        'locale' => 'vi',
        'title' => 'VI from group B',
        'slug' => 'vi-group-b',
        'status' => 'published',
        'published_at' => now()->subDay(),
    ]);
    Post::query()->create([
        'category_id' => null,
        'translation_group_id' => $groupRecentViOnly,
        'locale' => 'en',
        'title' => 'EN from group B',
        'slug' => 'en-group-b',
        'status' => 'published',
        'published_at' => now()->subDays(20),
    ]);

    $this->withSession(['locale' => 'vi'])
        ->get(route('home'))
        ->assertOk()
        ->assertSeeInOrder(['VI from group A', 'VI from group B'], false);
});

test('service subpages order locale posts by newest translation group activity', function () {
    $groupRecentlyUpdatedByEn = (string) Str::uuid();
    $groupRecentViOnly = (string) Str::uuid();

    Post::query()->create([
        'category_id' => null,
        'translation_group_id' => $groupRecentlyUpdatedByEn,
        'locale' => 'vi',
        'title' => 'Land VI from group A',
        'slug' => 'land-vi-group-a',
        'status' => 'published',
        'published_at' => now()->subDays(6),
    ]);
    Post::query()->create([
        'category_id' => null,
        'translation_group_id' => $groupRecentlyUpdatedByEn,
        'locale' => 'en',
        'title' => 'Land EN from group A',
        'slug' => 'land-en-group-a',
        'status' => 'published',
        'published_at' => now(),
    ]);

    Post::query()->create([
        'category_id' => null,
        'translation_group_id' => $groupRecentViOnly,
        'locale' => 'vi',
        'title' => 'Land VI from group B',
        'slug' => 'land-vi-group-b',
        'status' => 'published',
        'published_at' => now()->subDay(),
    ]);
    Post::query()->create([
        'category_id' => null,
        'translation_group_id' => $groupRecentViOnly,
        'locale' => 'en',
        'title' => 'Land EN from group B',
        'slug' => 'land-en-group-b',
        'status' => 'published',
        'published_at' => now()->subDays(14),
    ]);

    $this->withSession(['locale' => 'vi'])
        ->get(route('site.land'))
        ->assertOk()
        ->assertSeeInOrder(['Land VI from group A', 'Land VI from group B'], false);
});
