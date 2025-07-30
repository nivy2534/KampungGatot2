<?php

/*
|--------------------------------------------------------------------------
| Test Social Media Popup
|--------------------------------------------------------------------------
|
| Script untuk test popup sosial media
| Akses melalui: /test-popup
|
*/

use Illuminate\Support\Facades\Route;

Route::get('/test-popup', function () {
    return view('test-popup');
});
