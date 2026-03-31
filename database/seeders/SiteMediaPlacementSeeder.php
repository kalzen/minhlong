<?php

namespace Database\Seeders;

use App\Models\SiteMediaPlacement;
use Illuminate\Database\Seeder;

class SiteMediaPlacementSeeder extends Seeder
{
    public function run(): void
    {
        foreach (config('site_media.positions', []) as $key => $label) {
            SiteMediaPlacement::updateOrCreate(
                ['position_key' => $key],
                ['label' => $label]
            );
        }
    }
}
