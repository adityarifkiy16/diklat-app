<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    if (auth()->check()) {
        return '/dashboard';
    } else {
        return '/login';
    }
});

Route::middleware('auth')->group(function () {
    Route::middleware('role:1,2,3')->group(function () {
        Route::controller()
    });
});
