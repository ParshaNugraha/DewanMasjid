<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Public Routes
Route::get('/', function () {
    return view('home');
});

Route::get('/masjid', function () {
    return view('/datamasjid/index');
});

Route::get('/tentangdmi', function () {
    return view('/tentangdmi/index');
});

Route::get('/daftar', function () {
    return view('/users/create');
});

Route::resource('users', UserController::class);

// Authentication Routes
Route::post('/logout', function () {
    auth()->logout();
    return redirect('/');
})->name('logout');

// Admin Routes
use App\Http\Middleware\Admin;

Route::middleware(['auth', Admin::class])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.index');
    })->name('admin.dashboard');
});

Route::get('/test-middleware', function () {
    return 'Middleware works!';
})->middleware('admin');

Route::get('/login', function () {
    return view('/users/login');
});

use App\Http\Controllers\AuthController;

// ...

// Login Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');