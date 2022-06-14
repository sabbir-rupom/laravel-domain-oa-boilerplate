<?php

use App\Domains\SimplePage\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

Route::middleware([])->group(function () {
    /**
     * Unit Routes
     */
    Route::any('/unit/search', [ApiController::class, 'search'])->name('unit.search');
    Route::get('/unit/form', [ApiController::class, 'addform'])->name('unit.form');
    Route::post('/unit/save', [ApiController::class, 'save'])->name('unit.save');
    Route::get('/unit/edit/{unit}', [ApiController::class, 'edit'])->name('unit.edit');
    Route::put('/unit/edit/{unit}', [ApiController::class, 'save']);
    Route::delete('/unit/edit/{unit}', [ApiController::class, 'remove']);
    
});