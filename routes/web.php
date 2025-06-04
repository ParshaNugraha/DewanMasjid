<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MasjidController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PendaftarController;

/*
|--------------------------------------------------------------------------
| Public Routes (Tanpa login)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
});

//Halaman Deskripsi
Route::get('/masjids/{id}', [MasjidController::class, 'show'])->name('datamasjid.show');


// Halaman statis
Route::view('/berita', 'berita.index');
Route::view('/pengurus', 'pengurus.index');
Route::view('/tentangdmi', 'tentangdmi.index');

// Tampilan daftar masjid untuk umum
Route::get('/masjid', [MasjidController::class, 'index'])->name('datamasjid.index');

// Registrasi user (admin biasa bisa daftar)
Route::get('/daftar', [UserController::class, 'create'])->name('users.create');
Route::post('/daftar', [UserController::class, 'store'])->name('users.store');
Route::get('/registration-pending', [UserController::class, 'pending'])->name('registration.pending');

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

    // Data masjid milik admin
    Route::get('/admin/datamasjid', [MasjidController::class, 'adminIndex'])->name('admin.datamasjid');

    // Change password HARUS berada di dalam group ini
    Route::get('/admin/change-password', [MasjidController::class, 'showChangePasswordForm'])->name('password.change.form');
    Route::post('/admin/change-password', [MasjidController::class, 'changePassword'])->name('password.change');

    // Akses edit masjid milik sendiri
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

    // Dashboard superadmin
    Route::get('/superadmin/dashboard', [MasjidController::class, 'dashboardSuperadmin'])
        ->name('superadmin.dashboard');

    // ✅ Halaman daftar user admin yang belum disetujui
    Route::get('/superadmin/pendaftar', [PendaftarController::class, 'index'])
        ->name('pendaftar.index');

    // ✅ Setujui pendaftar
    Route::put('/superadmin/pendaftar/{user}/approve', [PendaftarController::class, 'approve'])
        ->name('pendaftar.approve');

    // ✅ Hapus (tolak) pendaftar
    Route::delete('/superadmin/pendaftar/{user}', [PendaftarController::class, 'destroy'])
        ->name('pendaftar.destroy');

    // User management
    Route::resource('users', UserController::class)->except(['create', 'store']);

    // Masjid management
    Route::resource('masjids', MasjidController::class)->except(['index']);
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
