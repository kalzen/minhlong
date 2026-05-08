<?php

use App\Models\SiteMediaLink;
use App\Models\SiteMediaPlacement;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

test('admin site media index includes section metadata per placement', function () {
    $user = User::factory()->create();
    SiteMediaPlacement::query()->updateOrCreate([
        'position_key' => 'sector.land.hero',
    ], [
        'label' => 'Land hero',
    ]);

    $this->withoutVite();

    $this->actingAs($user)
        ->get(route('admin.site-media.index'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('admin/SiteMedia/Index')
            ->has('placements')
            ->where('placements', function ($placements): bool {
                $row = collect($placements)->firstWhere('position_key', 'sector.land.hero');
                if (! is_array($row)) {
                    return false;
                }

                return ($row['section'] ?? null) === 'sector-land'
                    && ($row['section_order'] ?? null) === 30
                    && ($row['section_title'] ?? null) === 'Trang Minh Long Land';
            })
            ->has('placements.0')
        );
});

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
