<?php

use App\Domains\Product\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

Route::prefix('product')->group(function () {
    Route::redirect('/', '/list', 301);
    Route::get('/list', [IndexController::class, 'index'])->name('product.list');
});
