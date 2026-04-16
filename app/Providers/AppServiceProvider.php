<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\Setting;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
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
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureDefaults();

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
                    ->orderByRaw('COALESCE(published_at, created_at) DESC')
                    ->limit(3)
                    ->get()
                : collect());
        });
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
