<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogPageController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/blog', [BlogPageController::class, 'index'])->name('blog');

Route::get('/galeri', function () {
    return view('galeri');
})->name('galeri');

Route::get('/blog/article', function () {
    return view('article');
})->name('article');

Route::get('/belanja', function () {
    return view('shop');
})->name('shop');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Dummy single product page for all links
Route::get('/produk-detail', function () {
    return view('product');
})->name('product');
