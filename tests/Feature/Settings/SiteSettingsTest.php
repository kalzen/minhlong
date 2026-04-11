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
        'meta_keywords' => 'kw1, kw2',
        'default_meta_title' => 'Default title',
        'default_meta_description' => 'Default description',
        'contact_phone' => '0123456789',
        'contact_email' => 'contact@example.com',
        'contact_address_haiphong' => 'HP line 1',
        'contact_address_hanoi' => 'HN line 1',
        'contact_address' => '',
    ];

    $this->actingAs($user)
        ->from(route('settings.general.edit'))
        ->put(route('settings.general.update'), $payload)
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('settings.general.edit'));

    expect(Setting::query()->where('key', 'site_name')->value('value'))->toBe('Test Company');
    expect(Setting::query()->where('key', 'contact_address_haiphong')->value('value'))->toBe('HP line 1');
    expect(Setting::query()->where('key', 'contact_address')->value('value'))->toBeNull();
});
