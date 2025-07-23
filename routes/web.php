<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Homepage\HomepageController;
use App\Http\Controllers\BlogPageController;
use App\Http\Controllers\EventPageController;
use App\Http\Controllers\GaleriPageController;



Route::get('/', [HomepageController::class, 'index']);

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login-post', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name("logout");

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Ordinary people
Route::get('/blog', [BlogPageController::class, 'index'])->name('blog');
Route::get('/galeri', [GaleriPageController::class, 'index'])->name('galeri');
Route::get('/event', [EventPageController::class, 'index'])->name('event');

Route::middleware(['auth'])->group(
    function () {
        Route::get('/dashboard', function () {
            return view('cms.dashboard');
        })->name('dashboard');

        Route::get('/blogs', [BlogController::class, 'index']);
        Route::post('/blogs', [BlogController::class, 'index']);
        Route::get('/blogs/create', [BlogController::class, 'create']);
        Route::get('/blogs/edit/{blog}', [BlogController::class, 'edit'])->name("blogs.edit");
        Route::post('/blogs/save', [BlogController::class, 'store'])->name("blogs.save");
        Route::post('/blogs/update', [BlogController::class, 'update'])->name("blogs.update");
        Route::delete('/blogs/delete/{id}', [BlogController::class, 'destroy'])->name("blogs.delete");
    }
);
