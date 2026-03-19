<?php

use App\Http\Controllers\Site\BlogController;
use App\Http\Controllers\Site\ContactController;
use App\Http\Controllers\Site\HomeController;
use App\Models\AccessLog;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::get('/', HomeController::class)->name('site.home');
Route::view('/gioi-thieu', 'site.about', ['title' => 'About Us'])->name('site.about');
Route::view('/dich-vu', 'site.services', ['title' => 'Services'])->name('site.services');
Route::view('/minh-long-land', 'site.land', ['title' => 'Minh Long Land'])->name('site.land');
Route::view('/minh-long-power', 'site.power', ['title' => 'Minh Long Power'])->name('site.power');
Route::get('/blog', [BlogController::class, 'index'])->name('site.blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('site.blog.show');
Route::get('/lien-he', [ContactController::class, 'show'])->name('site.contact');
Route::post('/lien-he', [ContactController::class, 'store'])->name('site.contact.store');

Route::inertia('/welcome', 'Welcome', [
    'canRegister' => Features::enabled(Features::registration()),
])->name('welcome');

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
