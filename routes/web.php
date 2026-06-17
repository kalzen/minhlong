<?php

use App\Http\Controllers\Site\BlogController;
use App\Http\Controllers\Site\ContactController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\LibraryController;
use App\Models\AccessLog;
use App\Models\ActivityLog;
use App\Models\User;
use App\Sitemap\SiteSitemapBuilder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('/robots.txt', function () {
    $lines = [
        'User-agent: *',
        'Disallow: /admin',
        'Disallow: /dashboard',
        'Disallow: /settings',
        '',
        'Sitemap: '.url('/sitemap.xml'),
    ];

    return response(implode("\n", $lines), 200, [
        'Content-Type' => 'text/plain; charset=UTF-8',
    ]);
})->name('site.robots');

Route::get('/sitemap.xml', function (SiteSitemapBuilder $builder) {
    $path = public_path('sitemap.xml');

    if (! is_file($path)) {
        $builder->writeToPublic();
    }

    return response()->file($path, [
        'Content-Type' => 'application/xml; charset=UTF-8',
    ]);
})->name('site.sitemap');
Route::view('/gioi-thieu', 'site.about', ['title' => 'About Us'])->name('site.about');
Route::view('/dich-vu', 'site.services', ['title' => 'Services'])->name('site.services');
Route::view('/minh-long-land', 'site.land', ['title' => 'Minh Long Land'])->name('site.land');
Route::view('/minh-long-power', 'site.power', ['title' => 'Minh Long Power'])->name('site.power');
Route::view('/minh-long-host', 'site.host', ['title' => 'Minh Long Host'])->name('site.host');
Route::view('/minh-long-minerals', 'site.minerals', ['title' => 'Minh Long Minerals'])->name('site.minerals');

Route::get('/lang/{locale}', function (string $locale) {
    $supportedLocales = ['en', 'vi', 'zh'];
    if (! in_array($locale, $supportedLocales, true)) {
        abort(404);
    }

    session(['locale' => $locale]);

    return redirect()->to(url()->previous() ?: route('home'));
})->name('site.lang');

Route::get('/blog', [BlogController::class, 'index'])->name('site.blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('site.blog.show');
Route::get('/lien-he', [ContactController::class, 'show'])->name('site.contact');
Route::post('/lien-he', [ContactController::class, 'store'])->name('site.contact.store');

Route::get('/thu-vien', [LibraryController::class, 'index'])->name('site.library.index');
Route::get('/thu-vien/{libraryDocument}/tai-xuong', [LibraryController::class, 'download'])
    ->name('site.library.download');

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
