<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MasjidController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Public Routes (Tanpa login)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
});



// Halaman statis
Route::view('/berita', 'berita.index');
Route::view('/pengurus', 'pengurus.index');
Route::view('/tentangdmi', 'tentangdmi.index');

// Tampilan daftar masjid untuk umum
Route::get('/masjid', [MasjidController::class, 'index'])->name('masjid.index');

// Registrasi user (admin biasa bisa daftar)
Route::get('/daftar', [UserController::class, 'create'])->name('users.create');
Route::post('/daftar', [UserController::class, 'store'])->name('users.store');

// Login dan Logout
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Routes untuk Admin Biasa (role = admin)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    // Dashboard admin biasa
    Route::get('/admin/dashboard', function () {
        return view('admin.index');
    })->name('admin.dashboard');
    // Data masjid milik admin (hanya masjidnya sendiri)
    Route::get('/admin/datamasjid', [MasjidController::class, 'adminIndex'])->name('admin.datamasjid');

    // Admin bisa mengedit masjidnya sendiri, wajib pakai middleware pengecekan kepemilikan masjid
    Route::middleware(['masjid.owner:id'])->group(function () {
        Route::get('/masjids/{id}/edit', [MasjidController::class, 'edit'])->name('masjids.edit');
        Route::put('/masjids/{id}', [MasjidController::class, 'update'])->name('masjids.update');
        Route::delete('/masjids/{id}', [MasjidController::class, 'destroy'])->name('masjids.destroy');
    });
});

/*
|--------------------------------------------------------------------------
| Routes untuk Superadmin (role = superadmin)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:superadmin'])->group(function () {

    // Dashboard superadmin (bisa pakai dashboard berbeda atau sama dengan admin)
    Route::get('/superadmin/dashboard', [MasjidController::class, 'dashboardSuperadmin'])
    ->name('superadmin.dashboard');


    // Superadmin bisa kelola semua users kecuali registrasi (daftar) yang hanya di public route
    Route::resource('users', UserController::class)->except(['create', 'store']);

    // Superadmin bisa akses semua data masjid tanpa batasan
    Route::resource('masjids', MasjidController::class)->except(['index']); 
    // Kalau mau buat index khusus superadmin, bisa di masjidController juga
});


/*
|--------------------------------------------------------------------------
| Routes untuk Admin dan Superadmin (gabungan)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:superadmin,admin'])->group(function () {

    // Contoh route yang boleh diakses keduanya, jika ada
    // Route::get('/some-route', [SomeController::class, 'method'])->name('some.name');

});
