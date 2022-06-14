<?php

use Illuminate\Support\Facades\Route;

Route::prefix('core')->group(function () {
    Route::get('/', function () {
        return 'core working';
    });
});

