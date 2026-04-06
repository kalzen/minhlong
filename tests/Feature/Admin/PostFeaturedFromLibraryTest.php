<?php

use App\Models\EditorMediaItem;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake('public');
});

function postFeaturedMinimalPng(): string
{
    return base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8z8BQDwAEhQGfN/6a8AAAABJRU5ErkJggg==');
}

test('post can set featured image from editor library media id', function () {
    $user = User::factory()->create();
    $item = EditorMediaItem::query()->create(['user_id' => $user->id]);
    $item->addMedia(UploadedFile::fake()->create('lib.png', postFeaturedMinimalPng()))->toMediaCollection('image');
    $libraryMedia = $item->getFirstMedia('image');
    expect($libraryMedia)->not->toBeNull();

    $slug = 'post-lib-'.uniqid();

    $this->actingAs($user)->post(route('admin.posts.store'), [
        'locale' => 'en',
        'title' => 'From library',
        'slug' => $slug,
        'status' => 'draft',
        'featured_library_media_id' => $libraryMedia->id,
    ])->assertRedirect();

    $post = Post::query()->where('slug', $slug)->first();
    expect($post)->not->toBeNull()
        ->and($post->getFirstMedia('featured'))->not->toBeNull();
});
