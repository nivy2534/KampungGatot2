<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Homepage\HomepageController;
use App\Http\Controllers\BlogPageController;
use App\Http\Controllers\EventPageController;
use App\Http\Controllers\GaleriPageController;



Route::get('/', [HomepageController::class, 'index']);

Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

Route::post('/login-post', [AuthController::class, 'login'])->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name("logout")->middleware('auth');

Route::get('/register', function () {
    return view('auth.register');
})->name('register')->middleware('guest');

// Ordinary people
Route::get('/blog', [BlogPageController::class, 'index'])->name('blog');
Route::get('/blog/{slug}', [BlogPageController::class, 'show'])->name('blog.show');
Route::get('/galeri', [GaleriPageController::class, 'index'])->name('galeri');
Route::get('/event', [EventPageController::class, 'index'])->name('event');
Route::get('/event/{slug}', [EventPageController::class, 'show'])->name('event.show');

Route::middleware(['auth'])->group(
    function () {
        Route::get('/dashboard', function () {
            return view('cms.dashboard');
        })->name('dashboard');

        Route::prefix('dashboard')->group(function () {
          // Blog Related
          Route::get('/blogs', [BlogController::class, 'index']);
          Route::post('/blogs', [BlogController::class, 'index']);
          Route::get('/blogs/create', [BlogController::class, 'create']);
          Route::get('/blogs/edit/{blog}', [BlogController::class, 'edit'])->name("blogs.edit");
          Route::post('/blogs/save', [BlogController::class, 'store'])->name("blogs.save");
          Route::post('/blogs/update', [BlogController::class, 'update'])->name("blogs.update");
          Route::delete('/blogs/delete/{id}', [BlogController::class, 'destroy'])->name("blogs.delete");

          // Produk related
          Route::get('/products', [ProductController::class, 'index']);
          Route::post('/products', [ProductController::class, 'index']);
          Route::get('/products/create', [ProductController::class, 'create']);
          Route::get('/products/edit/{product}', [ProductController::class, 'edit'])->name("products.edit");
          Route::post('/products/save', [ProductController::class, 'store'])->name("products.save");
          Route::post('/products/update', [ProductController::class, 'update'])->name("products.update");
          Route::delete('/products/delete/{id}', [ProductController::class, 'destroy'])->name("products.delete");
          // Route::delete('/product-images/{id}', [ProductImageController::class, 'destroy']);
        });
    }
);
