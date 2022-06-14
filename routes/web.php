<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Artisan;

Route::get('/', [HomeController::class, 'index'])->name('index');


Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('optimize');

    return 'Cache data has been cleared';
});