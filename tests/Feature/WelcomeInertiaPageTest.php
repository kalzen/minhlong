<?php

test('welcome inertia page shows minh long group branding not laravel starter copy', function () {
    $this->withoutVite();

    $response = $this->get(route('welcome'));

    $response->assertSuccessful();
    $response->assertSee('<title inertia>Minh Long Group</title>', false);
    $response->assertSee('&quot;name&quot;:&quot;Minh Long Group&quot;', false);
    $response->assertDontSee('Laravel Starter Kit', false);
    $response->assertDontSee('laravel.com', false);
});
