<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiklatController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WilayahController;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard'); // Redirect to the dashboard or any other page
    } else {
        return redirect('/login');
    }
});


Route::controller(LoginController::class)->middleware('guest')->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'login');
});

Route::middleware('auth')->group(function () {
    Route::middleware(['role:1,2,3'])->group(function () {
        Route::get(
            '/dashboard',
            DashboardController::class
        )->name('dashboard');

        Route::controller(PesertaController::class)->prefix('peserta')->group(function () {
            Route::get('/', 'index')->name('peserta');
            Route::get('/create', 'create')->name('peserta.create');
            Route::post('/store', 'store')->name('peserta.store');
            Route::delete('/delete/{id}', 'deletePeserta');
        });

        Route::controller(WilayahController::class)->prefix('wilayah')->group(function () {
            Route::get('/get-provinces', 'getProv')->name('get.provinces');
            Route::get('/get-kotaprov', 'getKotaProv')->name('get.kotaprov');
            Route::get('/get-kota', 'getKota')->name('get.kota');
        });

        Route::controller(UserController::class)->prefix('user')->group(function () {
            Route::get('/', 'index')->name('user');
            Route::get('/create', 'create')->name('user.create');
            Route::post('/store', 'store')->name('user.store');
            Route::delete('/delete/{id}', 'deleteUser');
        });

        Route::controller(DiklatController::class)->prefix('diklat')->group(function () {
            Route::get('/', 'index')->name('diklat');
            Route::get('/create', 'create')->name('diklat.create');
            Route::post('/store', 'store')->name('diklat.store');
            Route::delete('/delete/{id}', 'deletediklat');
        });
    });
    Route::post('/logout', LogoutController::class)->name('logout');
});
