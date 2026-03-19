<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'key',
        'value',
        'group',
        'type',
    ];

    /**
     * Get all settings as key => value array (cached).
     *
     * @return array<string, string|null>
     */
    public static function getKeyValue(): array
    {
        return Cache::remember('settings_key_value', 3600, function () {
            return self::query()->pluck('value', 'key')->all();
        });
    }
}
