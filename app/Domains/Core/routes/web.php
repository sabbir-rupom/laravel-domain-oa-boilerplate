<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::prefix('core')->group(function () {
    Route::get('/', function () {
        return 'core working';
    });
});

Route::get('/cache/clear', function() {
    Artisan::call('cache:clear');

    return 'Cache data has been cleared';
});

Route::get('/cache/optimize', function() {
    Artisan::call('optimize');

    return 'Cache data has been optimized';
});

Route::get('/config/clear', function() {
    Artisan::call('config:clear');

    return 'Config cache data has been cleared';
});