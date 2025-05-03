<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/masjid', function () {
    return view('/datamasjid/index');
});