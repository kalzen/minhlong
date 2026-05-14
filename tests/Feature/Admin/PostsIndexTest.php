<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Inertia\Testing\AssertableInertia as Assert;

test('authenticated user can view admin posts index', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('admin.posts.index'))
        ->assertOk();
});

test('admin posts index orders translation groups by latest sibling updated_at', function () {
    $user = User::factory()->create();
    $olderGroup = (string) Str::uuid();
    $newerGroup = (string) Str::uuid();

    $base = [
        'category_id' => null,
        'excerpt' => 'e',
        'content' => '<p>x</p>',
        'status' => 'published',
        'published_at' => now(),
    ];

    Post::query()->create($base + [
        'translation_group_id' => $olderGroup,
        'locale' => 'vi',
        'title' => 'Older group VI',
        'slug' => 'older-vi-'.Str::lower(Str::random(8)),
    ]);
    Post::query()->create($base + [
        'translation_group_id' => $olderGroup,
        'locale' => 'en',
        'title' => 'Older group EN',
        'slug' => 'older-en-'.Str::lower(Str::random(8)),
    ]);

    $newerPost = Post::query()->create($base + [
        'translation_group_id' => $newerGroup,
        'locale' => 'vi',
        'title' => 'Newer group VI',
        'slug' => 'newer-vi-'.Str::lower(Str::random(8)),
    ]);

    DB::table('posts')
        ->where('translation_group_id', $olderGroup)
        ->where('locale', 'vi')
        ->update(['updated_at' => now()->subDays(3)]);
    DB::table('posts')
        ->where('translation_group_id', $olderGroup)
        ->where('locale', 'en')
        ->update(['updated_at' => now()->subDays(2)]);
    DB::table('posts')
        ->where('id', $newerPost->id)
        ->update(['updated_at' => now()]);

    $this->actingAs($user)
        ->get(route('admin.posts.index'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('admin/Posts/Index', false)
            ->where('posts.data.0.translation_group_id', $newerGroup)
            ->where('posts.data.1.translation_group_id', $olderGroup));
});
