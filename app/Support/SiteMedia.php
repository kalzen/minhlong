<?php

namespace App\Support;

use App\Models\SiteMediaPlacement;

class SiteMedia
{
    /**
     * Public URL for a configured site image position, or null if unset.
     */
    public static function url(string $positionKey): ?string
    {
        $placement = SiteMediaPlacement::query()
            ->where('position_key', $positionKey)
            ->first();

        if ($placement === null) {
            return null;
        }

        return $placement->getFirstMediaUrl('image') ?: null;
    }
}
