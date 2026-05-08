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

        $positions = collect(config('site_media.positions', []))
            ->keys()
            ->filter(fn (string $key): bool => str_starts_with($key, 'sector.') || str_starts_with($key, 'about.'))
            ->values();

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

        $keys = collect(config('site_media.positions', []))
            ->keys()
            ->filter(fn (string $key): bool => str_starts_with($key, 'sector.') || str_starts_with($key, 'about.'))
            ->values()
            ->all();

        SiteMediaPlacement::query()
            ->whereIn('position_key', $keys)
            ->delete();
    }
};
