<?php

use App\Models\User;
use App\Models\UserAiApiKey;
use Inertia\Testing\AssertableInertia as Assert;

test('ai key settings page is visible for authenticated user', function () {
    $user = User::factory()->create();
    $this->withoutVite();

    $this->actingAs($user)
        ->get(route('settings.ai-keys.edit'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page->component('settings/AiKeys'));
});

test('user can store multiple ai keys and set default per provider', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('settings.ai-keys.store'), [
            'provider' => 'openai',
            'name' => 'OpenAI primary',
            'api_key' => 'sk-openai-primary-abcdefghijklmnopqrstuvwxyz',
            'is_default' => true,
            'is_active' => true,
        ])
        ->assertRedirect(route('settings.ai-keys.edit'));

    $this->actingAs($user)
        ->post(route('settings.ai-keys.store'), [
            'provider' => 'openai',
            'name' => 'OpenAI backup',
            'api_key' => 'sk-openai-backup-abcdefghijklmnopqrstuvwxyz',
            'is_default' => true,
            'is_active' => true,
        ])
        ->assertRedirect(route('settings.ai-keys.edit'));

    expect(UserAiApiKey::query()->where('user_id', $user->id)->count())->toBe(2)
        ->and(
            UserAiApiKey::query()
                ->where('user_id', $user->id)
                ->where('provider', 'openai')
                ->where('is_default', true)
                ->value('name')
        )->toBe('OpenAI backup');
});
