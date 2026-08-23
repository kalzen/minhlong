<?php

use App\Models\Post;
use Illuminate\Support\Str;

/**
 * Each language lives on its own URL, so the matched route — not the session —
 * decides which language a page renders in.
 */
function makePost(array $attributes): Post
{
    return Post::query()->create($attributes + [
        'category_id' => null,
        'translation_group_id' => (string) Str::uuid(),
        'excerpt' => 'e',
        'content' => '<p>c</p>',
        'status' => 'published',
        'published_at' => now(),
    ]);
}

test('each locale serves its own blog post url', function () {
    $group = (string) Str::uuid();

    makePost([
        'translation_group_id' => $group,
        'locale' => 'en',
        'title' => 'English title',
        'slug' => 'english-only-slug',
    ]);

    makePost([
        'translation_group_id' => $group,
        'locale' => 'vi',
        'title' => 'Tiêu đề',
        'slug' => 'tieu-de-vi',
    ]);

    $this->get(route('site.blog.show.en', ['slug' => 'english-only-slug']))
        ->assertOk()
        ->assertSee('English title', false)
        ->assertSee('lang="en"', false);

    $this->get(route('site.blog.show.vi', ['slug' => 'tieu-de-vi']))
        ->assertOk()
        ->assertSee('Tiêu đề', false)
        ->assertSee('lang="vi"', false);
});

test('a slug reached on another locale path redirects permanently to its own url', function () {
    makePost([
        'locale' => 'en',
        'title' => 'English title',
        'slug' => 'english-only-slug',
    ]);

    $this->get(route('site.blog.show.vi', ['slug' => 'english-only-slug']))
        ->assertStatus(301)
        ->assertRedirect(route('site.blog.show.en', ['slug' => 'english-only-slug']));
});

test('unknown slug still 404s', function () {
    $this->get(route('site.blog.show.vi', ['slug' => 'no-such-post']))->assertNotFound();
});

test('the url locale wins over the session locale', function () {
    $this->withSession(['locale' => 'en'])
        ->get(route('home.vi'))
        ->assertOk()
        ->assertSee('lang="vi"', false);

    $this->withSession(['locale' => 'vi'])
        ->get(route('home.zh'))
        ->assertOk()
        ->assertSee('lang="zh"', false);
});

test('every localized page emits hreflang alternates for its siblings', function () {
    $response = $this->get(route('site.about.vi'))->assertOk();

    foreach (['vi', 'en', 'zh'] as $locale) {
        $response->assertSee('hreflang="'.$locale.'"', false);
    }

    $response->assertSee('hreflang="x-default"', false);
    $response->assertSee(route('site.about.en'), false);
    $response->assertSee(route('site.about.zh'), false);
});

test('home lists only posts for the url locale', function () {
    makePost(['locale' => 'en', 'title' => 'En only home', 'slug' => 'en-only-home']);
    makePost(['locale' => 'vi', 'title' => 'Vi only home', 'slug' => 'vi-only-home']);

    $this->get(route('home.vi'))
        ->assertOk()
        ->assertSee('Vi only home', false)
        ->assertDontSee('En only home', false)
        ->assertSee(route('site.blog.show.vi', ['slug' => 'vi-only-home']), false);
});

test('home blog placeholder when no posts for locale links to blog index', function () {
    makePost([
        'locale' => 'en',
        'title' => 'English only',
        'slug' => 'english-only-placeholder',
    ]);

    $this->get(route('home.vi'))
        ->assertOk()
        ->assertSee(route('site.blog.index.vi'), false)
        ->assertDontSee('english-only-placeholder', false);
});

test('home orders locale posts by newest translation group activity', function () {
    $groupRecentlyUpdatedByEn = (string) Str::uuid();
    $groupRecentViOnly = (string) Str::uuid();

    makePost([
        'translation_group_id' => $groupRecentlyUpdatedByEn,
        'locale' => 'vi',
        'title' => 'VI from group A',
        'slug' => 'vi-group-a',
        'published_at' => now()->subDays(7),
    ]);
    makePost([
        'translation_group_id' => $groupRecentlyUpdatedByEn,
        'locale' => 'en',
        'title' => 'EN from group A',
        'slug' => 'en-group-a',
    ]);

    makePost([
        'translation_group_id' => $groupRecentViOnly,
        'locale' => 'vi',
        'title' => 'VI from group B',
        'slug' => 'vi-group-b',
        'published_at' => now()->subDay(),
    ]);
    makePost([
        'translation_group_id' => $groupRecentViOnly,
        'locale' => 'en',
        'title' => 'EN from group B',
        'slug' => 'en-group-b',
        'published_at' => now()->subDays(20),
    ]);

    $this->get(route('home.vi'))
        ->assertOk()
        ->assertSeeInOrder(['VI from group A', 'VI from group B'], false);
});

test('service subpages order locale posts by newest translation group activity', function () {
    $groupRecentlyUpdatedByEn = (string) Str::uuid();
    $groupRecentViOnly = (string) Str::uuid();

    makePost([
        'translation_group_id' => $groupRecentlyUpdatedByEn,
        'locale' => 'vi',
        'title' => 'Land VI from group A',
        'slug' => 'land-vi-group-a',
        'published_at' => now()->subDays(6),
    ]);
    makePost([
        'translation_group_id' => $groupRecentlyUpdatedByEn,
        'locale' => 'en',
        'title' => 'Land EN from group A',
        'slug' => 'land-en-group-a',
    ]);

    makePost([
        'translation_group_id' => $groupRecentViOnly,
        'locale' => 'vi',
        'title' => 'Land VI from group B',
        'slug' => 'land-vi-group-b',
        'published_at' => now()->subDay(),
    ]);
    makePost([
        'translation_group_id' => $groupRecentViOnly,
        'locale' => 'en',
        'title' => 'Land EN from group B',
        'slug' => 'land-en-group-b',
        'published_at' => now()->subDays(14),
    ]);

    $this->get(route('site.land.vi'))
        ->assertOk()
        ->assertSeeInOrder(['Land VI from group A', 'Land VI from group B'], false);
});
