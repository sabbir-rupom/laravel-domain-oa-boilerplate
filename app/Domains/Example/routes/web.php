<?php

use App\Domains\Example\Http\Controllers\ExampleAction;
use Illuminate\Support\Facades\Route;

Route::get('example', [ExampleAction::class, 'index'])->name('example');