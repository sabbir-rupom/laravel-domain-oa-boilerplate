<?php

use App\Domains\Product\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

Route::prefix('product')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('product');
    Route::redirect('/list', '/', 301);
});
