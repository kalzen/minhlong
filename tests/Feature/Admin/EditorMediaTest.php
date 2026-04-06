<?php

use App\Models\EditorMediaItem;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * 1×1 PNG (không cần GD) — dùng cho UploadedFile::fake()->create().
 */
function editorMediaMinimalPng(): string
{
    return base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8z8BQDwAEhQGfN/6a8AAAABJRU5ErkJggg==');
}

beforeEach(function () {
    Storage::fake('public');
});

test('guests cannot list editor media', function () {
    $response = $this->getJson(route('admin.editor-media.index'));

    $response->assertUnauthorized();
});

test('authenticated users can list editor media json', function () {
    $user = User::factory()->create();
    $item = EditorMediaItem::query()->create(['user_id' => $user->id]);
    $item->addMedia(UploadedFile::fake()->create('a.png', editorMediaMinimalPng()))->toMediaCollection('image');

    $this->actingAs($user);

    $response = $this->getJson(route('admin.editor-media.index'));

    $response->assertOk();
    $response->assertJsonStructure([
        'data' => [
            '*' => ['id', 'url', 'thumb_url', 'name'],
        ],
        'meta',
    ]);
});

test('authenticated users can upload editor image via spatie', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $file = UploadedFile::fake()->create('photo.png', editorMediaMinimalPng());

    $response = $this->postJson(route('admin.editor-media.store'), [
        'upload' => $file,
    ]);

    $response->assertOk();
    $response->assertJsonStructure(['url', 'id']);

    expect(EditorMediaItem::query()->count())->toBe(1)
        ->and(EditorMediaItem::query()->first()?->getMedia('image')->count())->toBe(1);
});
