<?php

use App\Models\SiteMediaLink;
use App\Models\SiteMediaPlacement;
use App\Models\User;

test('admin can save site image url on a placement', function () {
    $user = User::factory()->create();
    $placement = SiteMediaPlacement::query()->create([
        'position_key' => 'brand.logo_header',
        'label' => 'Header logo',
    ]);

    $this->actingAs($user)
        ->post(route('admin.site-media.update', $placement), [
            'image_url' => 'https://cdn.example.com/logo.png',
        ])
        ->assertRedirect(route('admin.site-media.index'));

    expect(SiteMediaLink::query()->where('position_key', 'brand.logo_header')->value('url'))
        ->toBe('https://cdn.example.com/logo.png');
});

test('admin can clear stored site image url', function () {
    $user = User::factory()->create();
    $placement = SiteMediaPlacement::query()->create([
        'position_key' => 'brand.logo_header',
        'label' => 'Header logo',
    ]);

    SiteMediaLink::query()->updateOrCreate(
        ['position_key' => 'brand.logo_header'],
        [
            'label' => 'Header logo',
            'url' => 'https://cdn.example.com/old.png',
        ]
    );

    $this->actingAs($user)
        ->post(route('admin.site-media.update', $placement), [
            'image_url' => '',
        ])
        ->assertRedirect(route('admin.site-media.index'));

    expect(SiteMediaLink::query()->where('position_key', 'brand.logo_header')->exists())->toBeFalse();
});
