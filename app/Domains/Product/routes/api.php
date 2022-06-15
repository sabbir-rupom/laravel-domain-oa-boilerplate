<?php

use App\Domains\Product\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'product', 'as' => 'product.'], function () {

    Route::any('/search', [ApiController::class, 'search'])->name('search');
    Route::get('/form', [ApiController::class, 'addform'])->name('form');
    Route::post('/store', [ApiController::class, 'save'])->name('store');
    Route::get('/edit/{product}', [ApiController::class, 'edit'])->name('edit');
    Route::put('/edit/{product}', [ApiController::class, 'save'])->name('update');
    Route::delete('/edit/{product}', [ApiController::class, 'remove']);

});
