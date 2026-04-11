<?php

namespace Database\Seeders;

use App\Models\SiteMediaLink;
use Illuminate\Database\Seeder;

class SiteMediaLinkSeeder extends Seeder
{
    /**
     * Seed default image paths / URLs from config into site_media_links (legacy assets as DB records).
     */
    public function run(): void
    {
        $positions = config('site_media.positions', []);
        $defaults = config('site_media.defaults', []);

        foreach ($positions as $positionKey => $label) {
            $raw = $defaults[$positionKey] ?? null;
            if (! is_string($raw) || $raw === '') {
                continue;
            }

            SiteMediaLink::query()->updateOrCreate(
                ['position_key' => $positionKey],
                [
                    'label' => is_string($label) ? $label : null,
                    'url' => $raw,
                ]
            );
        }
    }
}
