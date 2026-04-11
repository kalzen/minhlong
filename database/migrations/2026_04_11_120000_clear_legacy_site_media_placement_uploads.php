<?php

use App\Models\SiteMediaPlacement;
use Database\Seeders\SiteMediaLinkSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Legacy SiteMediaPlacementSeeder copied default images into Spatie storage, so URLs pointed at
     * /storage/{id}/... instead of public/frontend/images/.... Remove those uploads so
     * SiteMedia::urlOrDefault falls back to site_media_links / config (frontend paths).
     * User uploads via admin still go to storage and take precedence.
     */
    public function up(): void
    {
        if (! Schema::hasTable('site_media_placements')) {
            return;
        }

        foreach (SiteMediaPlacement::query()->cursor() as $placement) {
            $placement->clearMediaCollection('image');
        }

        if (Schema::hasTable('site_media_links')) {
            (new SiteMediaLinkSeeder)->run();
        }
    }

    public function down(): void
    {
        //
    }
};
