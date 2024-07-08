<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;


Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard'); // Redirect to the dashboard or any other page
    } else {
        return redirect('/login');
    }
});


Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'login');
});

// Route::middleware('auth')->group(function () {
//     Route::middleware('role:1,2,3')->group(function () {
//         Route::prefix('index')->controller(UserController::class)
//     });
// });
