<?php

use App\Models\Setting;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

test('site settings page requires authentication', function () {
    $this->get(route('settings.general.edit'))
        ->assertRedirect(route('login'));
});

test('site settings page is displayed for authenticated user', function () {
    $user = User::factory()->create();

    $this->withoutVite();

    $this->actingAs($user)
        ->get(route('settings.general.edit'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('settings/General'),
        );
});

test('site settings can be updated', function () {
    $user = User::factory()->create();

    $this->withoutVite();

    $payload = [
        'site_name' => 'Test Company',
        'site_slogan' => 'We build things',
        'meta_title' => 'Test Meta Title',
        'meta_description' => 'Test meta description',
        'contact_phone' => '0123456789',
        'contact_email' => 'contact@example.com',
        'contact_address' => '123 Test Street',
    ];

    $this->actingAs($user)
        ->from(route('settings.general.edit'))
        ->put(route('settings.general.update'), $payload)
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('settings.general.edit'));

    foreach ($payload as $key => $value) {
        expect(Setting::query()->where('key', $key)->value('value'))->toBe($value);
    }
});
