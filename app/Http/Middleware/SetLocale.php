<?php

namespace App\Http\Middleware;

use App\Support\SitePages;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * The matched route wins: every public page is registered once per locale
     * and carries a `locale` default, so one URL always renders one language
     * regardless of what the session held. The session is only a fallback for
     * routes that are not locale-specific (admin, auth), and is kept in sync so
     * those screens follow the language the visitor was last reading.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $routeLocale = $request->route()?->defaults['locale'] ?? null;

        if (SitePages::isSupported($routeLocale)) {
            app()->setLocale($routeLocale);

            if ($request->session()->get('locale') !== $routeLocale) {
                $request->session()->put('locale', $routeLocale);
            }

            return $next($request);
        }

        $locale = $request->session()->get('locale');

        app()->setLocale(SitePages::isSupported($locale) ? $locale : SitePages::defaultLocale());

        return $next($request);
    }
}
