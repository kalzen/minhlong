<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Editable image positions (see PROJECT_REQUIREMENTS.md §12.4)
    |--------------------------------------------------------------------------
    */
    'positions' => [
        'brand.logo_header' => 'Header logo',
        'brand.favicon' => 'Favicon',
        'hero.home.main' => 'Home hero main',
        'hero.home.info_1' => 'Home hero info image 1',
        'hero.home.info_2' => 'Home hero info image 2',
        'home.about.image_1' => 'Home about image 1',
        'home.about.image_2' => 'Home about image 2',
        'home.about.video_poster' => 'Home about — video poster / intro image',
        'home.services.land' => 'Home services — Land',
        'home.services.host' => 'Home services — Host',
        'home.services.minerals' => 'Home services — Minerals',
        'home.services.power' => 'Home services — Power',
        'sector.land.hero' => 'Minh Long Land hero',
        'sector.host.hero' => 'Minh Long Host hero',
        'sector.power.hero' => 'Minh Long Power hero',
        'sector.minerals.hero' => 'Minh Long Minerals hero',
        'og.default_image' => 'Default Open Graph image',
    ],

    /*
    |--------------------------------------------------------------------------
    | Fallback URLs when no upload exists and no row in site_media_links (path for
    | asset(), or absolute http(s) URL). Seeded via SiteMediaLinkSeeder; blades use
    | SiteMedia::urlOrDefault().
    |--------------------------------------------------------------------------
    */
    'defaults' => [
        'brand.logo_header' => 'frontend/images/logo.png',
        'brand.favicon' => 'frontend/images/favicon.svg',
        'hero.home.main' => 'frontend/images/hero-bg-image.jpg',
        'hero.home.info_1' => 'frontend/images/hero-info-image-1.jpg',
        'hero.home.info_2' => 'frontend/images/hero-info-image-2.jpg',
        'home.about.image_1' => 'frontend/images/about-us-image-1.jpg',
        'home.about.image_2' => 'frontend/images/about-us-image-2.jpg',
        'home.about.video_poster' => 'frontend/images/about-intro-video-image.jpg',
        'home.services.land' => 'frontend/images/minhlong-land.png',
        'home.services.host' => 'frontend/images/minhlong-host.jpg',
        'home.services.minerals' => 'frontend/images/minerals/about-quarry-conveyors.png',
        'home.services.power' => 'frontend/images/minhlong-power.jpg',
        'sector.land.hero' => 'frontend/images/hero-image-gold.jpg',
        'sector.host.hero' => 'frontend/images/minhlong-host-1.png',
        'sector.power.hero' => 'frontend/images/power-3.jpg',
        'sector.minerals.hero' => 'https://images.pexels.com/photos/8247090/pexels-photo-8247090.jpeg',
        'og.default_image' => 'frontend/images/minhlong-land.png',
    ],
];
