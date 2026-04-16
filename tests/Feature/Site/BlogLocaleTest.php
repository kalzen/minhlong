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
        ->assertDontSee('En only home', false);
});
