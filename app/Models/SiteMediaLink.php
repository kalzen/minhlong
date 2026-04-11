<?php

namespace App\Models;

use App\Support\SiteMedia;
use Illuminate\Database\Eloquent\Model;

/**
 * Stored image URL or public-relative path per site_media position_key.
 * Used by {@see SiteMedia} when no file is uploaded on {@link SiteMediaPlacement}.
 */
class SiteMediaLink extends Model
{
    protected $fillable = [
        'position_key',
        'url',
        'label',
    ];
}
