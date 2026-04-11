<?php

use App\Models\SiteMediaPlacement;
use Database\Seeders\SiteMediaPlacementSeeder;

test('public disk url is restored after the request finishes', function () {
    $before = config('filesystems.disks.public.url');

    // Use an absolute URL: Laravel's prepareUrlForRequest() turns "/" into url("/") (APP_URL host).
    $this->call('GET', 'http://mlg.test/', [], [], [], [
        'HTTP_HOST' => 'mlg.test',
        'SERVER_PORT' => '80',
        'REQUEST_URI' => '/',
        'SCRIPT_NAME' => '/index.php',
        'PHP_SELF' => '/index.php',
        'REQUEST_METHOD' => 'GET',
        'SERVER_PROTOCOL' => 'HTTP/1.1',
        'HTTPS' => 'off',
    ]);

    expect(config('filesystems.disks.public.url'))->toBe($before);
});

test('uploaded site media urls use the incoming request host', function () {
    if (! is_file(public_path('frontend/images/logo.png'))) {
        $this->markTestSkipped('Default logo file missing from public/frontend/images.');
    }

    $this->seed(SiteMediaPlacementSeeder::class);

    $placement = SiteMediaPlacement::query()
        ->where('position_key', 'brand.logo_header')
        ->first();
    expect($placement)->not->toBeNull();
    $placement->clearMediaCollection('image');
    $placement->addMedia(public_path('frontend/images/logo.png'))
        ->preservingOriginal()
        ->toMediaCollection('image');

    $response = $this->call('GET', 'http://mlg.test/', [], [], [], [
        'HTTP_HOST' => 'mlg.test',
        'SERVER_PORT' => '80',
        'REQUEST_URI' => '/',
        'SCRIPT_NAME' => '/index.php',
        'PHP_SELF' => '/index.php',
        'REQUEST_METHOD' => 'GET',
        'SERVER_PROTOCOL' => 'HTTP/1.1',
        'HTTPS' => 'off',
    ]);

    $response->assertOk();
    $response->assertSee('http://mlg.test/storage/', false);
});
