<?php

namespace App\Support;

use App\Models\SiteMediaLink;
use App\Models\SiteMediaPlacement;
use Illuminate\Support\Facades\Schema;

class SiteMedia
{
    /**
     * Public URL for a configured site image position, or null if unset.
     */
    public static function url(string $positionKey): ?string
    {
        if (! Schema::hasTable('site_media_placements')) {
            return null;
        }

        $placement = SiteMediaPlacement::query()
            ->where('position_key', $positionKey)
            ->first();

        if ($placement === null) {
            return null;
        }

        return $placement->getFirstMediaUrl('image') ?: null;
    }

    /**
     * Uploaded media URL, stored link row, or configured default (asset path or absolute URL).
     */
    public static function urlOrDefault(string $positionKey): string
    {
        $uploaded = static::url($positionKey);
        if ($uploaded !== null && $uploaded !== '') {
            return $uploaded;
        }

        if (Schema::hasTable('site_media_links')) {
            $link = SiteMediaLink::query()
                ->where('position_key', $positionKey)
                ->first();

            if ($link !== null && $link->url !== null && trim($link->url) !== '') {
                return static::publicUrlFromStoredValue($link->url);
            }
        }

        /** @var array<string, string> $defaults */
        $defaults = config('site_media.defaults', []);
        $fallback = $defaults[$positionKey] ?? null;
        if ($fallback === null || $fallback === '') {
            return '';
        }

        return static::publicUrlFromStoredValue($fallback);
    }

    /**
     * Ensure a public media URL is absolute (for Open Graph, Twitter cards, JSON-LD).
     */
    public static function absoluteUrl(string $urlOrPath): string
    {
        $trimmed = trim($urlOrPath);
        if ($trimmed === '') {
            return '';
        }

        if (str_starts_with($trimmed, 'http://') || str_starts_with($trimmed, 'https://')) {
            return $trimmed;
        }

        return url($trimmed);
    }

    private static function publicUrlFromStoredValue(string $value): string
    {
        $value = trim($value);
        if ($value === '') {
            return '';
        }

        if (str_starts_with($value, 'http://') || str_starts_with($value, 'https://')) {
            return $value;
        }

        return asset($value);
    }
}
