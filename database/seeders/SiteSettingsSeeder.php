<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class SiteSettingsSeeder extends Seeder
{
    private const SITE_BRAND = 'Minh Long Group';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $metaTitle = self::SITE_BRAND;
        $metaDescription = 'Minh Long Group delivers industrial EPC and turnkey factory construction, land and real estate development, minerals and aggregates, and power and energy solutions across Vietnam and the region.';

        $settings = [
            ['key' => 'site_name', 'value' => self::SITE_BRAND, 'group' => 'general', 'type' => 'string'],
            ['key' => 'site_slogan', 'value' => 'Construction, land, power & minerals — Minh Long Group', 'group' => 'general', 'type' => 'string'],
            ['key' => 'site_logo', 'value' => null, 'group' => 'general', 'type' => 'string'],
            ['key' => 'meta_title', 'value' => $metaTitle, 'group' => 'general', 'type' => 'string'],
            ['key' => 'meta_description', 'value' => $metaDescription, 'group' => 'general', 'type' => 'string'],
            ['key' => 'default_meta_title', 'value' => $metaTitle, 'group' => 'general', 'type' => 'string'],
            ['key' => 'default_meta_description', 'value' => $metaDescription, 'group' => 'general', 'type' => 'string'],
            ['key' => 'meta_keywords', 'value' => 'Minh Long Group, industrial construction, EPC Vietnam, factory building, land development, real estate Vietnam, minerals, aggregates, quarry, power plant, energy solutions, Minh Long Land, Minh Long Power, tập đoàn Minh Long, xây dựng công nghiệp, bất động sản, năng lượng', 'group' => 'seo', 'type' => 'string'],
            ['key' => 'og_type', 'value' => 'website', 'group' => 'seo', 'type' => 'string'],
            ['key' => 'twitter_card', 'value' => 'summary_large_image', 'group' => 'seo', 'type' => 'string'],
            ['key' => 'meta_robots', 'value' => 'index, follow', 'group' => 'seo', 'type' => 'string'],
            ['key' => 'contact_phone', 'value' => '088 6656 899', 'group' => 'contact', 'type' => 'string'],
            ['key' => 'contact_email', 'value' => 'info@mlgroup.vn', 'group' => 'contact', 'type' => 'string'],
            ['key' => 'contact_address_haiphong', 'value' => 'SH6.11 Vinhomes Marina, Phường An Biên, Hải Phòng', 'group' => 'contact', 'type' => 'string'],
            ['key' => 'contact_address_hanoi', 'value' => '676 Hoàng Hoa Thám, Ba Đình, Hà Nội', 'group' => 'contact', 'type' => 'string'],
            ['key' => 'contact_address', 'value' => null, 'group' => 'contact', 'type' => 'string'],
            ['key' => 'social_facebook', 'value' => null, 'group' => 'social', 'type' => 'string'],
            ['key' => 'social_linkedin', 'value' => null, 'group' => 'social', 'type' => 'string'],
            ['key' => 'social_instagram', 'value' => null, 'group' => 'social', 'type' => 'string'],
            ['key' => 'social_youtube', 'value' => null, 'group' => 'social', 'type' => 'string'],
            ['key' => 'social_zalo', 'value' => null, 'group' => 'social', 'type' => 'string'],
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
