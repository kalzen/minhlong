<?php

use App\Http\Controllers\Site\BlogController;
use App\Http\Controllers\Site\ContactController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\LibraryController;
use App\Models\AccessLog;
use App\Models\ActivityLog;
use App\Models\User;
use App\Sitemap\SiteSitemapBuilder;
use App\Support\SitePages;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;

/*
 | Public pages are registered once per locale from config/site_pages.php so
 | that each language lives on its own URL. Route names carry the locale
 | suffix (site.about.vi); route('site.about') resolves to the right one via
 | App\Routing\LocalizedUrlGenerator.
 */
$pages = SitePages::all();

foreach (SitePages::locales() as $locale) {
    $slug = fn (string $key) => $pages[$key]['slugs'][$locale] ?? null;

    Route::get('/'.ltrim((string) $slug('home'), '/'), HomeController::class)
        ->defaults('locale', $locale)
        ->name('home.'.$locale);

    foreach (['about', 'services', 'land', 'power', 'host', 'minerals'] as $key) {
        Route::view('/'.$slug($key), $pages[$key]['view'])
            ->defaults('locale', $locale)
            ->name($pages[$key]['name'].'.'.$locale);
    }

    Route::get('/'.$slug('blog'), [BlogController::class, 'index'])
        ->defaults('locale', $locale)
        ->name('site.blog.index.'.$locale);

    Route::get('/'.$slug('blog').'/{slug}', [BlogController::class, 'show'])
        ->defaults('locale', $locale)
        ->name('site.blog.show.'.$locale);

    Route::get('/'.$slug('contact'), [ContactController::class, 'show'])
        ->defaults('locale', $locale)
        ->name('site.contact.'.$locale);

    Route::post('/'.$slug('contact'), [ContactController::class, 'store'])
        ->defaults('locale', $locale)
        ->name('site.contact.store.'.$locale);

    Route::get('/'.$slug('library'), [LibraryController::class, 'index'])
        ->defaults('locale', $locale)
        ->name('site.library.index.'.$locale);

    Route::get('/'.$slug('library').'/{libraryDocument}/'.$pages['library']['download_slugs'][$locale], [LibraryController::class, 'download'])
        ->defaults('locale', $locale)
        ->name('site.library.download.'.$locale);
}

Route::get('/robots.txt', function () {
    $lines = [
        'User-agent: *',
        'Disallow: /admin',
        'Disallow: /dashboard',
        'Disallow: /settings',
        'Disallow: /login',
        'Disallow: /register',
        'Disallow: /forgot-password',
        'Disallow: /reset-password',
        'Disallow: /lang/',
        ...collect(SitePages::all()['library']['download_slugs'] ?? [])
            ->map(fn (string $downloadSlug, string $locale) => 'Disallow: /'
                .SitePages::all()['library']['slugs'][$locale].'/*/'.$downloadSlug)
            ->values()
            ->all(),
        'Allow: /',
        '',
        'Sitemap: '.url('/sitemap.xml'),
    ];

    return response(implode("\n", $lines), 200, [
        'Content-Type' => 'text/plain; charset=UTF-8',
        'Cache-Control' => 'public, max-age=3600',
    ]);
})->name('site.robots');

Route::get('/sitemap.xml', function (SiteSitemapBuilder $builder) {
    $builder->refreshIfStale();

    return response()->file($builder->path(), [
        'Content-Type' => 'application/xml; charset=UTF-8',
        'Cache-Control' => 'public, max-age=3600',
    ]);
})->name('site.sitemap');
Route::get('/lang/{locale}', function (string $locale) {
    if (! SitePages::isSupported($locale)) {
        abort(404);
    }

    session(['locale' => $locale]);

    return redirect()->to(route('home.'.$locale));
})->name('site.lang');

Route::inertia('/welcome', 'Welcome')->name('welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard', [
        'dashboard' => fn () => [
            'totalVisits' => AccessLog::query()->count(),
            'visitsToday' => AccessLog::query()
                ->whereDate('created_at', Carbon::today())
                ->count(),
            'totalUsers' => User::query()->count(),
            'recentActivities' => ActivityLog::query()
                ->latest()
                ->limit(10)
                ->get(['id', 'action', 'created_at']),
        ],
    ])->name('dashboard');
});

require __DIR__.'/settings.php';
require __DIR__.'/admin.php';
