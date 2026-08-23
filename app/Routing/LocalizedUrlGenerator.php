<?php

namespace App\Routing;

use Illuminate\Routing\UrlGenerator;

/**
 * Resolves locale-agnostic route names to the current locale's variant.
 *
 * Public pages are registered once per locale under names like `site.about.vi`.
 * Views and controllers keep calling route('site.about'); this generator maps
 * that to `site.about.<current locale>` when such a route exists, so every
 * internal link stays in the language the visitor is currently reading.
 *
 * Names that have no localized variant (admin, auth, API) pass through
 * untouched.
 */
class LocalizedUrlGenerator extends UrlGenerator
{
    /**
     * {@inheritdoc}
     */
    public function route($name, $parameters = [], $absolute = true)
    {
        if (is_string($name) && ! $this->routes->hasNamedRoute($name)) {
            $localized = $name.'.'.app()->getLocale();

            if ($this->routes->hasNamedRoute($localized)) {
                $name = $localized;
            } else {
                $fallback = $name.'.'.config('site_pages.default_locale', config('app.locale', 'en'));

                if ($this->routes->hasNamedRoute($fallback)) {
                    $name = $fallback;
                }
            }
        }

        return parent::route($name, $parameters, $absolute);
    }
}
