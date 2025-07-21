<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogPageController;
use App\Http\Controllers\EventPageController;
use App\Http\Controllers\GaleriPageController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/blog', [BlogPageController::class, 'index'])->name('blog');

Route::get('/galeri', [GaleriPageController::class, 'index']);

Route::get('/blog/article', function () {
    return view('article');
})->name('article');

Route::get('/event', function () {
    return view('event');
})->name('event');

Route::get('/event', [EventPageController::class, 'index'])->name('event');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/dashboard', function () {
    return view('cms.dashboard');
})->name('dashboard');

// Dummy single product page for all links
Route::get('/produk-detail', function () {
    return view('product');
})->name('product');
