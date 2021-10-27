<?php

use Converter\WebpConverter\Controllers\WebpController;
use Illuminate\Support\Facades\Route;

if (config('webp.enabled', false) === true) {
    Route::group([
        'prefix' => config('webp.prefix'),
        'as' => 'webp.',
        'middleware' => config('webp.middleware')
    ], function () {
        Route::get('/get-path', [WebpController::class, 'show'])->name('get-path');
        Route::post('/convert', [WebpController::class, 'convert'])->name('convert');
    });
}