<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Homepage\HomepageController;


Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/', function () {
    return view('welcome');
});


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
        Route::get('/blogs/create', [BlogController::class, 'create']);
        Route::get('/blogs/edit/{blog}', [BlogController::class, 'edit'])->name("blogs.edit");
        Route::post('/blogs/save', [BlogController::class, 'store'])->name("blogs.save");
        Route::post('/blogs/update', [BlogController::class, 'update'])->name("blogs.update");
        Route::delete('/blogs/delete/{id}', [BlogController::class, 'destroy'])->name("blogs.delete");
    }
);

Route::get('/blog',[BlogController::class, 'index'])->name('blog');
Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blog');
Route::get('/blog/slug/{slug}', [BlogController::class, 'showBySlug'])->name('blog');
Route::get('/blog/search',[BlogController::class, 'search'])->name('blog');
Route::get('/blog/published', [BlogController::class, 'getPublished'])->name('blog');
Route::get('/blog/count', [BlogController::class, 'countByStatus'])->name('blog');

