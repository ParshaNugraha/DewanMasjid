<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('home');
});

Route::get('/masjid', function () {
    return view('/datamasjid/index');
});

Route::get('/daftar', function () {
    return view('/users/create');
});
Route::resource('users', UserController::class);