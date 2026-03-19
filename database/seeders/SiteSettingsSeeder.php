<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class SiteSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'site_name', 'value' => config('app.name'), 'group' => 'general', 'type' => 'string'],
            ['key' => 'site_logo', 'value' => null, 'group' => 'general', 'type' => 'string'],
            ['key' => 'default_meta_title', 'value' => config('app.name').' - Construction & Design', 'group' => 'general', 'type' => 'string'],
            ['key' => 'default_meta_description', 'value' => 'Industrial EPC and factory construction solutions.', 'group' => 'general', 'type' => 'string'],
            ['key' => 'contact_phone', 'value' => '088 6656 899', 'group' => 'contact', 'type' => 'string'],
            ['key' => 'contact_email', 'value' => 'info@mlgroup.vn', 'group' => 'contact', 'type' => 'string'],
            ['key' => 'contact_address', 'value' => 'Minh Long Group, Viet Nam', 'group' => 'contact', 'type' => 'string'],
        ];

        foreach ($settings as $item) {
            Setting::updateOrCreate(
                ['key' => $item['key']],
                $item
            );
        }

        Cache::forget('settings_key_value');
    }
}
