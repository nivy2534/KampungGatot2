<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BlogController;



Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login-post', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name("logout");

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::middleware(['auth'])->group(
    function () {
        Route::get('/dashboard', function () {
            return view('cms.dashboard');
        })->name('dashboard');

        Route::get('/blogs', [BlogController::class, 'index']);
        Route::post('/blogs', [BlogController::class, 'index']);
    }
);
