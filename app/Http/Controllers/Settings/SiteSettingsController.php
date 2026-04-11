<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\SiteSettingsUpdateRequest;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Inertia\Response;

class SiteSettingsController extends Controller
{
    /**
     * @var list<string>
     */
    private const SETTING_KEYS = [
        'site_name',
        'site_slogan',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'default_meta_title',
        'default_meta_description',
        'contact_phone',
        'contact_email',
        'contact_address_haiphong',
        'contact_address_hanoi',
        'contact_address',
        'social_facebook',
        'social_linkedin',
        'social_instagram',
        'social_youtube',
        'social_zalo',
    ];

    /**
     * Display the site settings page.
     */
    public function edit(Request $request): Response
    {
        $settings = Setting::query()
            ->whereIn('key', self::SETTING_KEYS)
            ->pluck('value', 'key')
            ->all();

        return Inertia::render('settings/General', [
            'settings' => [
                'site_name' => $settings['site_name'] ?? config('app.name'),
                'site_slogan' => $settings['site_slogan'] ?? null,
                'meta_title' => $settings['meta_title'] ?? null,
                'meta_description' => $settings['meta_description'] ?? null,
                'meta_keywords' => $settings['meta_keywords'] ?? null,
                'default_meta_title' => $settings['default_meta_title'] ?? null,
                'default_meta_description' => $settings['default_meta_description'] ?? null,
                'contact_phone' => $settings['contact_phone'] ?? null,
                'contact_email' => $settings['contact_email'] ?? null,
                'contact_address_haiphong' => $settings['contact_address_haiphong'] ?? null,
                'contact_address_hanoi' => $settings['contact_address_hanoi'] ?? null,
                'contact_address' => $settings['contact_address'] ?? null,
                'social_facebook' => $settings['social_facebook'] ?? null,
                'social_linkedin' => $settings['social_linkedin'] ?? null,
                'social_instagram' => $settings['social_instagram'] ?? null,
                'social_youtube' => $settings['social_youtube'] ?? null,
                'social_zalo' => $settings['social_zalo'] ?? null,
            ],
        ]);
    }

    /**
     * Update the site settings.
     */
    public function update(SiteSettingsUpdateRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        foreach ($validated as $key => $value) {
            $stored = is_string($value) && $value === '' ? null : $value;

            Setting::query()->updateOrCreate(
                ['key' => $key],
                [
                    'value' => $stored,
                    'group' => $this->resolveSettingGroup((string) $key),
                    'type' => 'string',
                ],
            );
        }

        Cache::forget('settings_key_value');

        return to_route('settings.general.edit');
    }

    private function resolveSettingGroup(string $key): string
    {
        return match (true) {
            str_starts_with($key, 'contact_') => 'contact',
            str_starts_with($key, 'meta_') => 'seo',
            str_starts_with($key, 'social_') => 'social',
            default => 'general',
        };
    }
}
