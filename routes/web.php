<?php

use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MasjidController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BeritaController;
/*
|--------------------------------------------------------------------------
| Public Routes (Tanpa login)
|--------------------------------------------------------------------------
*/

Route::get('/', function (Request $request) {
    Visitor::create([
        'ip_address' => $request->ip(), // ini dari instance $request, bukan facade
        'user_agent' => $request->header('User-Agent'),
    ]);
    return view('home');
});



// Halaman statis
// Halaman publik berita tanpa middleware
Route::get('/berita', [BeritaController::class, 'publicIndex'])->name('berita.publicIndex');
Route::get('/berita/{id}', [BeritaController::class, 'publicShow'])->name('berita.show');
Route::view('/pengurus', 'pengurus.index');
Route::view('/tentangdmi', 'tentangdmi.index');

// Tampilan daftar masjid untuk umum
Route::get('/masjid', [MasjidController::class, 'index'])->name('datamasjid.index');
Route::get('/masjids/{id}', [MasjidController::class, 'show'])->name('datamasjid.show');

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

Route::middleware(['auth', 'role:superadmin'])->prefix('superadmin')->name('superadmin.')->group(function () {
    
    // Dashboard superadmin
    Route::get('/dashboard', [AdminController::class, 'dashboardSuperadmin'])->name('dashboard');

    // Halaman daftar user admin yang belum disetujui
    Route::get('/pendaftar', [PendaftarController::class, 'index'])->name('pendaftar.index');
    Route::put('/pendaftar/{user}/approve', [PendaftarController::class, 'approve'])->name('pendaftar.approve');
    Route::delete('/pendaftar/{user}', [PendaftarController::class, 'destroy'])->name('pendaftar.destroy');

    // Route berita superadmin
    Route::prefix('berita')->name('berita.')->group(function () {
        Route::get('/', [BeritaController::class, 'index'])->name('index');
        Route::get('/create', [BeritaController::class, 'create'])->name('create');
        Route::post('/', [BeritaController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [BeritaController::class, 'edit'])->name('edit');
        Route::put('/{id}', [BeritaController::class, 'update'])->name('update');
        Route::delete('/{id}', [BeritaController::class, 'destroy'])->name('destroy');

    });
});


Route::middleware(['auth', 'role:admin'])->group(function () {
    // Dashboard admin
    Route::get('/admin/dashboard', [AdminController::class, 'adminIndex'])->name('admin.dashboard');
});



Route::middleware(['auth', 'role:admin,superadmin'])->group(function () {
    // Crud masjid
    Route::get('/masjids/{id}/edit', [AdminController::class, 'edit'])->name('masjids.edit');
    Route::put('/masjids/{id}', [AdminController::class, 'update'])->name('masjids.update');
    Route::delete('/masjids/{id}', [AdminController::class, 'destroy'])->name('masjids.destroy');

    // Ganti Pw
    Route::get('/change-password', [AdminController::class, 'showChangePasswordForm'])->name('password.change.form');
    Route::post('/change-password', [AdminController::class, 'changePassword'])->name('password.change');
});
