<?php

use App\Models\SiteMediaLink;
use App\Models\SiteMediaPlacement;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $keys = [
            'home.about.image_1_slide_2',
            'home.about.image_1_slide_3',
            'home.about.image_1_slide_4',
            'home.about.image_1_slide_5',
            'home.about.image_1_slide_6',
            'home.about.image_2_slide_2',
            'home.about.image_2_slide_3',
            'home.about.image_2_slide_4',
            'home.about.image_2_slide_5',
            'home.about.image_2_slide_6',
        ];

        if (Schema::hasTable('site_media_links')) {
            SiteMediaLink::query()->whereIn('position_key', $keys)->delete();
        }

        if (Schema::hasTable('site_media_placements')) {
            SiteMediaPlacement::query()->whereIn('position_key', $keys)->delete();
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('site_media_placements')) {
            return;
        }

        foreach ([
            'home.about.image_1_slide_2',
            'home.about.image_1_slide_3',
            'home.about.image_1_slide_4',
            'home.about.image_1_slide_5',
            'home.about.image_1_slide_6',
            'home.about.image_2_slide_2',
            'home.about.image_2_slide_3',
            'home.about.image_2_slide_4',
            'home.about.image_2_slide_5',
            'home.about.image_2_slide_6',
        ] as $key) {
            SiteMediaPlacement::query()->updateOrCreate(
                ['position_key' => $key],
                ['label' => str_replace('_', ' ', $key)]
            );
        }
    }
};
