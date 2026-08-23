<?php

namespace App\Support;

/**
 * Cache-busting URLs for the unfingerprinted files in public/frontend.
 *
 * The theme's CSS/JS ship under fixed names, so a long browser cache would
 * otherwise pin visitors to a stale copy after an edit. Appending the file's
 * modification time changes the URL whenever the file changes, which lets
 * .htaccess serve them as immutable for a year.
 */
class AssetVersion
{
    /** @var array<string, string> */
    private static array $cache = [];

    public static function url(string $path): string
    {
        if (isset(self::$cache[$path])) {
            return self::$cache[$path];
        }

        $url = asset($path);
        $file = public_path($path);

        if (is_file($file)) {
            $url .= '?v='.filemtime($file);
        }

        return self::$cache[$path] = $url;
    }
}
