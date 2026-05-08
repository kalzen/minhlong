<?php

use App\Models\SiteMediaPlacement;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('site_media_placements')) {
            return;
        }

        $positions = [
            'home.about.image_1_slide_2' => 'Home about image 1 - slide 2',
            'home.about.image_2_slide_2' => 'Home about image 2 - slide 2',
        ];

        foreach ($positions as $key => $label) {
            SiteMediaPlacement::query()->updateOrCreate(
                ['position_key' => $key],
                ['label' => $label]
            );
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('site_media_placements')) {
            return;
        }

        SiteMediaPlacement::query()
            ->whereIn('position_key', [
                'home.about.image_1_slide_2',
                'home.about.image_2_slide_2',
            ])
            ->delete();
    }
};
