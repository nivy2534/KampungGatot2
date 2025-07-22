<?php

use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\PhotoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\ProductController;

/* Route::post('/register', [AuthController::class, 'register']);
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
Route::get('/products/{id}', [ProductController::class, 'show']); */
