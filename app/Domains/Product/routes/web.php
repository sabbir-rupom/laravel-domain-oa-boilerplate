<?php

use App\Domains\SimplePage\Http\Controllers\ApiController;
use App\Domains\SimplePage\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Route;

Route::prefix('simplepage')->group(function () {
    Route::get('/', function () {
        return 'test';
    });
});

Route::get('/unit', [UnitController::class, 'index'])->name('unit.list');