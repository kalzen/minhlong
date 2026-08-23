<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\Setting;
use App\Routing\LocalizedUrlGenerator;
use App\Sitemap\SiteSitemapBuilder;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Swap in a URL generator that understands per-locale route names, so
        // existing route('site.about') calls keep working and point at the
        // slug for the language currently being read.
        $this->app->extend('url', function (UrlGenerator $url, $app) {
            $localized = new LocalizedUrlGenerator(
                $app['router']->getRoutes(),
                $url->getRequest(),
                $app['config']['app.asset_url']
            );

            $localized->setSessionResolver(fn () => $app['session'] ?? null);
            $localized->setKeyResolver(function () use ($app) {
                $config = $app->make('config');

                return [$config->get('app.key'), ...($config->get('app.previous_keys') ?? [])];
            });

            $app->rebinding('request', fn ($app, $request) => $localized->setRequest($request));
            $app->rebinding('routes', fn ($app, $routes) => $localized->setRoutes($routes));

            return $localized;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureDefaults();
        $this->keepSitemapFresh();
        $this->sharePageSeoDefaults();

        Model::shouldBeStrict(! app()->isProduction());

        $shareSettings = function ($view): void {
            $view->with('settings', Schema::hasTable('settings')
                ? Setting::getKeyValue()
                : []);
        };
        View::composer([
            'layouts.minhlong',
            'site.home',
            'site.about',
            'site.services',
            'site.contact',
            'site.blog.index',
            'site.blog.show',
            'site.partials.home-sections',
            'site.partials.home-hero',
            'site.land',
            'site.host',
            'site.power',
            'site.minerals',
            'site.library.index',
        ], $shareSettings);

        View::composer([
            'site.land',
            'site.host',
            'site.power',
            'site.minerals',
        ], function ($view): void {
            $view->with('latestBlogPosts', Schema::hasTable('posts')
                ? Post::query()
                    ->where('status', 'published')
                    ->forLocale(app()->getLocale())
                    ->withFeaturedMedia()
                    ->with('category')
                    ->orderByLatestTranslationGroup()
                    ->limit(3)
                    ->get()
                : collect());
        });
    }

    /**
     * Give every static public page its own title and meta description.
     *
     * Route::view() pages carry no controller, so without this they would all
     * inherit the site-wide description and compete as near-duplicates.
     */
    protected function sharePageSeoDefaults(): void
    {
        $seoKeyByView = [
            'site.home' => 'home',
            'site.about' => 'about',
            'site.services' => 'services',
            'site.land' => 'land',
            'site.power' => 'power',
            'site.host' => 'host',
            'site.minerals' => 'minerals',
            'site.contact' => 'contact',
            'site.library.index' => 'library',
        ];

        foreach ($seoKeyByView as $viewName => $seoKey) {
            View::composer($viewName, function ($view) use ($seoKey): void {
                $data = $view->getData();

                if (! array_key_exists('metaTitle', $data)) {
                    $view->with('metaTitle', __('site.seo.'.$seoKey.'.title'));
                }

                if (! array_key_exists('metaDescription', $data)) {
                    $view->with('metaDescription', __('site.seo.'.$seoKey.'.description'));
                }
            });
        }
    }

    /**
     * Invalidate the cached sitemap.xml whenever indexable content changes,
     * so publishing a post is reflected on the next /sitemap.xml request.
     */
    protected function keepSitemapFresh(): void
    {
        $invalidate = function (): void {
            if (! app()->runningUnitTests()) {
                app(SiteSitemapBuilder::class)->invalidate();
            }
        };

        Post::saved($invalidate);
        Post::deleted($invalidate);
    }

    /**
     * Configure default behaviors for production-ready applications.
     */
    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(fn (): ?Password => app()->isProduction()
            ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
            : null,
        );
    }
}
