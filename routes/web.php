<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BlogController;



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
    }
);

Route::get('/blog',[BlogController::class, 'index'])->name('blog');
Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blog');
Route::get('/blog/slug/{slug}', [BlogController::class, 'showBySlug'])->name('blog');
Route::get('/blog/search',[BlogController::class, 'search'])->name('blog');
Route::get('/blog/published', [BlogController::class, 'getPublished'])->name('blog');
Route::get('/blog/count', [BlogController::class, 'countByStatus'])->name('blog');

/*Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/ping', function () {
    return response()->json(['message' => 'API working!']);
});

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/logout', [AuthController::class, 'logout']);

    //CRUD photo
    Route::post('/photos',[PhotoController::class, 'store']);
    Route::put('/photos/{id}', [PhotoController::class, 'update']);
    Route::delete('/photos/{id}',[PhotoController::class, 'destroy']);

    //CRUD events
    Route::post('/events', [EventController::class, 'store']);
    Route::put('/events/{id}', [EventController::class, 'update']);
    Route::delete('/events/{id}', [EventController::class, 'destroy']);

    //CRUD blogs
    Route::post('/blogs', [BlogController::class, 'store']);
    Route::put('/blogs/{id}', [BlogController::class, 'update']);
    Route::delete('/blogs/{id}', [BlogController::class, 'destroy']);

    //CRUD products
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);

    //CRUD uploadImg
    Route::post('/articles/upload-image', [BlogController::class, 'uploadImage']);
});

Route::get('/photos', [PhotoController::class, 'index']);
Route::get('/photos/{id}',[PhotoController::class, 'show']);
Route::get('/photos/ping',function(){
    return response()->json(['message' => 'photo working!']);
});
Route::get('/photos/count', [PhotoController::class, 'count']);


Route::get('/events',[EventController::class, 'index']);
Route::get('/events/{id}', [EventController::class, 'show']);


Route::get('/blogs',[BlogController::class, 'index']);
Route::get('/blogs/{id}', [BlogController::class, 'show']);
Route::get('/blogs/slug/{slug}', [BlogController::class, 'showBySlug']);
Route::get('/blogs/search',[BlogController::class, 'search']);
Route::get('/blogs/published', [BlogController::class, 'getPublished']);
Route::get('/blogs/count', [BlogController::class, 'countByStatus']);


Route::get('/produtcs',[ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
*/