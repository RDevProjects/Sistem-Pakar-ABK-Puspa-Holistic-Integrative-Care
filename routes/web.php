<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\AuthAndRoleMiddleware;

Route::middleware([AuthAndRoleMiddleware::class])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');
});


