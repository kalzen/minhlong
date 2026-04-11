<?php

use Database\Seeders\SiteMediaLinkSeeder;
use Database\Seeders\SiteMediaPlacementSeeder;
use Database\Seeders\SiteSettingsSeeder;

test('home page renders seeded meta description keywords robots and open graph tags', function () {
    $this->seed(SiteMediaPlacementSeeder::class);
    $this->seed(SiteMediaLinkSeeder::class);
    $this->seed(SiteSettingsSeeder::class);

    $response = $this->get(route('home'));

    $response->assertOk();
    $response->assertSee('<title>Minh Long Group</title>', false);
    $response->assertSee('property="og:title" content="Minh Long Group"', false);
    $response->assertSee('industrial EPC and turnkey factory construction', false);
    $response->assertSee('name="keywords"', false);
    $response->assertSee('Minh Long Group, industrial construction', false);
    $response->assertSee('name="robots" content="index, follow"', false);
    $response->assertSee('rel="canonical"', false);
    $response->assertSee('property="og:title"', false);
    $response->assertSee('property="og:image"', false);
    $response->assertSee('minhlong-land.png', false);
    $response->assertSee('name="twitter:card" content="summary_large_image"', false);
});
