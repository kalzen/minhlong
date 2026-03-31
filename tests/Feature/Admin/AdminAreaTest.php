<?php

use App\Models\User;

test('guests are redirected to login when visiting admin posts', function () {
    $response = $this->get(route('admin.posts.index'));

    $response->assertRedirect(route('login'));
});

test('authenticated users can visit admin posts index', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $this->withoutVite();

    $response = $this->get(route('admin.posts.index'));

    $response->assertOk();
});
