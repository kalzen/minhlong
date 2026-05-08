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
            'hero.home.info_1_slide_2',
            'hero.home.info_1_slide_3',
            'hero.home.info_1_slide_4',
            'hero.home.info_1_slide_5',
            'hero.home.info_1_slide_6',
            'hero.home.info_2_slide_2',
            'hero.home.info_2_slide_3',
            'hero.home.info_2_slide_4',
            'hero.home.info_2_slide_5',
            'hero.home.info_2_slide_6',
        ];

        foreach ($positions as $key) {
            SiteMediaPlacement::query()->updateOrCreate(
                ['position_key' => $key],
                ['label' => (string) config("site_media.positions.$key")]
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
                'hero.home.info_1_slide_2',
                'hero.home.info_1_slide_3',
                'hero.home.info_1_slide_4',
                'hero.home.info_1_slide_5',
                'hero.home.info_1_slide_6',
                'hero.home.info_2_slide_2',
                'hero.home.info_2_slide_3',
                'hero.home.info_2_slide_4',
                'hero.home.info_2_slide_5',
                'hero.home.info_2_slide_6',
            ])
            ->delete();
    }
};
