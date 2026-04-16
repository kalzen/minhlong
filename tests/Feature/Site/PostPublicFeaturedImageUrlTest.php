<?php

use App\Models\Post;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

beforeEach(function () {
    Storage::fake('public');
});

function postListingMinimalPng(): string
{
    return base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8z8BQDwAEhQGfN/6a8AAAABJRU5ErkJggg==');
}

test('publicFeaturedImageUrl returns featured media url when set', function () {
    $post = Post::query()->create([
        'category_id' => null,
        'translation_group_id' => (string) Str::uuid(),
        'locale' => 'en',
        'title' => 'Featured media',
        'slug' => 'featured-media-'.uniqid(),
        'excerpt' => 'x',
        'content' => '<p>x</p>',
        'thumbnail_path' => null,
        'status' => 'published',
        'published_at' => now(),
    ]);

    $post->addMedia(UploadedFile::fake()->create('hero.png', postListingMinimalPng()))->toMediaCollection('featured');

    $url = $post->fresh()->publicFeaturedImageUrl();

    expect($url)->not->toBeNull()
        ->and($url)->not->toContain('unsplash');
});

test('publicFeaturedImageUrl prefers featured media over thumbnail_path', function () {
    $post = Post::query()->create([
        'category_id' => null,
        'translation_group_id' => (string) Str::uuid(),
        'locale' => 'en',
        'title' => 'Both',
        'slug' => 'both-'.uniqid(),
        'excerpt' => 'x',
        'content' => '<p>x</p>',
        'thumbnail_path' => 'frontend/images/post-1.jpg',
        'status' => 'published',
        'published_at' => now(),
    ]);

    $post->addMedia(UploadedFile::fake()->create('from-media.png', postListingMinimalPng()))->toMediaCollection('featured');

    $url = $post->fresh()->publicFeaturedImageUrl();

    expect($url)->not->toBeNull()
        ->and($url)->not->toContain('post-1.jpg');
});

test('publicFeaturedImageUrl falls back to thumbnail_path when file exists', function () {
    $post = Post::query()->create([
        'category_id' => null,
        'translation_group_id' => (string) Str::uuid(),
        'locale' => 'en',
        'title' => 'Legacy thumb',
        'slug' => 'legacy-'.uniqid(),
        'excerpt' => 'x',
        'content' => '<p>x</p>',
        'thumbnail_path' => 'frontend/images/post-1.jpg',
        'status' => 'published',
        'published_at' => now(),
    ]);

    expect($post->publicFeaturedImageUrl())->toContain('post-1');
});

test('publicFeaturedImageUrl returns null when no image', function () {
    $post = Post::query()->create([
        'category_id' => null,
        'translation_group_id' => (string) Str::uuid(),
        'locale' => 'en',
        'title' => 'No image',
        'slug' => 'no-image-'.uniqid(),
        'excerpt' => 'x',
        'content' => '<p>x</p>',
        'thumbnail_path' => null,
        'status' => 'published',
        'published_at' => now(),
    ]);

    expect($post->publicFeaturedImageUrl())->toBeNull();
});
