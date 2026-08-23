<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * The theme images were re-encoded as WebP (roughly 75% smaller). Config and
 * Blade references were updated in code, but the `site_media_links` rows live
 * in the database, so every environment needs this data fix of its own.
 *
 * Only rows whose WebP file is actually present are touched, and Open Graph
 * images are left alone because social scrapers still handle WebP unevenly.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('site_media_links')) {
            return;
        }

        foreach (DB::table('site_media_links')->get() as $link) {
            $url = (string) ($link->url ?? '');

            if (! str_starts_with($url, 'frontend/images/')) {
                continue;
            }

            if (str_starts_with((string) $link->position_key, 'og.')) {
                continue;
            }

            $webp = preg_replace('/\.(jpe?g|png)$/i', '.webp', $url);

            if ($webp === $url || ! is_file(public_path($webp))) {
                continue;
            }

            DB::table('site_media_links')
                ->where('id', $link->id)
                ->update(['url' => $webp]);
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('site_media_links')) {
            return;
        }

        // Fall back to whichever original format is still on disk.
        foreach (DB::table('site_media_links')->get() as $link) {
            $url = (string) ($link->url ?? '');

            if (! str_starts_with($url, 'frontend/images/') || ! str_ends_with($url, '.webp')) {
                continue;
            }

            foreach (['jpg', 'jpeg', 'png', 'JPG'] as $extension) {
                $original = substr($url, 0, -4).$extension;

                if (is_file(public_path($original))) {
                    DB::table('site_media_links')
                        ->where('id', $link->id)
                        ->update(['url' => $original]);

                    break;
                }
            }
        }
    }
};
