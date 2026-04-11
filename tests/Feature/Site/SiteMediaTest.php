<?php

use App\Models\SiteMediaLink;
use App\Models\SiteMediaPlacement;
use App\Support\SiteMedia;

test('site media urlOrDefault resolves dotted position keys from config defaults', function () {
    $url = SiteMedia::urlOrDefault('brand.logo_header');

    expect($url)->not->toBe('')
        ->and($url)->toContain('frontend/images/logo.png');
});

test('site media urlOrDefault prefers uploaded media url over default', function () {
    if (! is_file(public_path('frontend/images/logo.png'))) {
        $this->markTestSkipped('Default logo file missing from public/frontend/images.');
    }

    $placement = SiteMediaPlacement::query()->create([
        'position_key' => 'brand.logo_header',
        'label' => 'Header logo',
    ]);

    $placement->addMedia(public_path('frontend/images/logo.png'))
        ->preservingOriginal()
        ->toMediaCollection('image');

    $url = SiteMedia::urlOrDefault('brand.logo_header');

    expect($url)->toContain('/storage/');
});

test('site media urlOrDefault uses site_media_links when no upload exists', function () {
    SiteMediaLink::query()->updateOrCreate(
        ['position_key' => 'brand.logo_header'],
        [
            'label' => 'Header logo',
            'url' => 'frontend/images/logo.png',
        ]
    );

    $url = SiteMedia::urlOrDefault('brand.logo_header');

    expect($url)->not->toBe('')
        ->and($url)->toContain('frontend/images/logo.png');
});

test('site media urlOrDefault does not use storage when only a frontend link is stored', function () {
    SiteMediaLink::query()->updateOrCreate(
        ['position_key' => 'hero.home.info_1'],
        [
            'label' => 'Hero info 1',
            'url' => 'frontend/images/hero-info-image-1.jpg',
        ]
    );

    $url = SiteMedia::urlOrDefault('hero.home.info_1');

    expect($url)->not->toContain('/storage/')
        ->and($url)->toContain('hero-info-image-1.jpg');
});
