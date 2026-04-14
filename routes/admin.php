<?php

use App\Http\Controllers\Admin\ContactInboxController;
use App\Http\Controllers\Admin\EditorMediaController;
use App\Http\Controllers\Admin\LibraryDocumentController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SiteMediaPlacementController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function (): void {
    Route::get('/', fn () => redirect()->route('admin.posts.index'))->name('home');

    Route::resource('posts', PostController::class)->except(['show']);
    Route::post('posts/seo-meta-suggestion', [PostController::class, 'seoMetaSuggestion'])->name('posts.seo-meta-suggestion');
    Route::post('posts/{post}/translate-locale', [PostController::class, 'translateLocale'])->name('posts.translate-locale');
    Route::post('posts/{post}/translate-missing-locales', [PostController::class, 'translateMissingLocales'])->name('posts.translate-missing-locales');
    Route::resource('projects', ProjectController::class)->except(['show']);
    Route::resource('library-documents', LibraryDocumentController::class)->parameters([
        'library-documents' => 'library_document',
    ]);

    Route::get('contacts', [ContactInboxController::class, 'index'])->name('contacts.index');
    Route::get('contacts/{contact}', [ContactInboxController::class, 'show'])->name('contacts.show');
    Route::patch('contacts/{contact}', [ContactInboxController::class, 'update'])->name('contacts.update');

    Route::get('site-media', [SiteMediaPlacementController::class, 'index'])->name('site-media.index');
    Route::post('site-media/{site_media_placement}', [SiteMediaPlacementController::class, 'update'])->name('site-media.update');

    Route::get('editor-media', [EditorMediaController::class, 'index'])->name('editor-media.index');
    Route::post('editor-media', [EditorMediaController::class, 'store'])->name('editor-media.store');
    Route::post('editor-media/folders', [EditorMediaController::class, 'storeFolder'])->name('editor-media.folders.store');
});
