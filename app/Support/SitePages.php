<?php

namespace App\Support;

use Illuminate\Support\Facades\Route;

/**
 * Lookup helpers for the localized public pages defined in config/site_pages.php.
 */
class SitePages
{
    /**
     * @return list<string>
     */
    public static function locales(): array
    {
        /** @var list<string> $locales */
        $locales = config('site_pages.locales', ['en']);

        return $locales;
    }

    public static function defaultLocale(): string
    {
        return (string) config('site_pages.default_locale', config('app.locale', 'en'));
    }

    public static function isSupported(?string $locale): bool
    {
        return $locale !== null && in_array($locale, static::locales(), true);
    }

    /**
     * @return array<string, array{name: string, view?: string, seo?: string, slugs: array<string, string>}>
     */
    public static function all(): array
    {
        /** @var array<string, array{name: string, view?: string, seo?: string, slugs: array<string, string>}> $pages */
        $pages = config('site_pages.pages', []);

        return $pages;
    }

    /**
     * Route name for a page in a given locale, e.g. `site.about.vi`.
     */
    public static function routeName(string $baseName, ?string $locale = null): string
    {
        return $baseName.'.'.($locale ?? app()->getLocale());
    }

    /**
     * URL of a page in a given locale, or null when that page/locale is unknown.
     */
    public static function url(string $pageKey, ?string $locale = null): ?string
    {
        $page = static::all()[$pageKey] ?? null;

        if ($page === null) {
            return null;
        }

        $name = static::routeName($page['name'], $locale);

        return Route::has($name) ? route($name) : null;
    }

    /**
     * Every locale variant of the page the current request is on.
     *
     * Returns [locale => absolute url], used to emit hreflang tags.
     *
     * @return array<string, string>
     */
    public static function alternatesForCurrentRoute(): array
    {
        $currentName = Route::currentRouteName();

        if ($currentName === null) {
            return [];
        }

        // Strip the trailing locale segment: `site.about.vi` -> `site.about`.
        $segments = explode('.', $currentName);
        $last = array_pop($segments);

        if (! static::isSupported($last) || $segments === []) {
            return [];
        }

        $baseName = implode('.', $segments);
        $alternates = [];

        foreach (static::locales() as $locale) {
            $name = static::routeName($baseName, $locale);

            if (Route::has($name)) {
                $alternates[$locale] = route($name);
            }
        }

        return $alternates;
    }
}
