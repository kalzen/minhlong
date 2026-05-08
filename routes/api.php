<?php

use App\Http\Controllers\Api\AIMarketingPostController;
use Illuminate\Support\Facades\Route;

Route::middleware('aimarketing.token')->group(function (): void {
    Route::post('/posts', AIMarketingPostController::class);
});
