<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\SiteSettingsUpdateRequest;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SiteSettingsController extends Controller
{
    /**
     * Display the site settings page.
     */
    public function edit(Request $request): Response
    {
        $settings = Setting::query()
            ->whereIn('key', [
                'site_name',
                'site_slogan',
                'meta_title',
                'meta_description',
                'contact_phone',
                'contact_email',
                'contact_address',
            ])
            ->pluck('value', 'key')
            ->all();

        return Inertia::render('settings/General', [
            'settings' => [
                'site_name' => $settings['site_name'] ?? config('app.name'),
                'site_slogan' => $settings['site_slogan'] ?? null,
                'meta_title' => $settings['meta_title'] ?? null,
                'meta_description' => $settings['meta_description'] ?? null,
                'contact_phone' => $settings['contact_phone'] ?? null,
                'contact_email' => $settings['contact_email'] ?? null,
                'contact_address' => $settings['contact_address'] ?? null,
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
            Setting::query()->updateOrCreate(
                ['key' => $key],
                [
                    'value' => $value,
                    'group' => str_starts_with($key, 'contact_') ? 'contact' : 'general',
                    'type' => 'string',
                ],
            );
        }

        return to_route('settings.general.edit');
    }
}
