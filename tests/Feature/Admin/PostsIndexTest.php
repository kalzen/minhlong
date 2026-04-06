<?php

use App\Models\User;

test('authenticated user can view admin posts index', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('admin.posts.index'))
        ->assertOk();
});
