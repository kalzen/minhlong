<?php

use App\Http\Controllers\Settings\AiApiKeyController;
use App\Http\Controllers\Settings\ProfileController;
use App\Http\Controllers\Settings\SecurityController;
use App\Http\Controllers\Settings\SiteSettingsController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', '/settings/profile');

    Route::get('settings/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('settings/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('settings/general', [SiteSettingsController::class, 'edit'])->name('settings.general.edit');
    Route::put('settings/general', [SiteSettingsController::class, 'update'])->name('settings.general.update');
    Route::get('settings/ai-keys', [AiApiKeyController::class, 'edit'])->name('settings.ai-keys.edit');
    Route::post('settings/ai-keys', [AiApiKeyController::class, 'store'])->name('settings.ai-keys.store');
    Route::put('settings/ai-keys/{user_ai_api_key}', [AiApiKeyController::class, 'update'])->name('settings.ai-keys.update');
    Route::delete('settings/ai-keys/{user_ai_api_key}', [AiApiKeyController::class, 'destroy'])->name('settings.ai-keys.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::delete('settings/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('settings/security', [SecurityController::class, 'edit'])->name('security.edit');

    Route::put('settings/password', [SecurityController::class, 'update'])
        ->middleware('throttle:6,1')
        ->name('user-password.update');

    Route::inertia('settings/appearance', 'settings/Appearance')->name('appearance.edit');
});
