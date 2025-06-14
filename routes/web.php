<?php

use App\Models\Berita;
use App\Models\Galeri;
use Illuminate\Http\Request;
use App\Helpers\VisitorHelper;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\MasjidController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\PendaftarController;
/*
|--------------------------------------------------------------------------
| Public Routes (Tanpa login)
|--------------------------------------------------------------------------
*/



// Route untuk halaman home
Route::get('/', function (Request $request) {
    VisitorHelper::recordVisitor($request, 'home');
    
    $beritas = Berita::latest()->get();
    $galeris = Galeri::latest()->get();
    
    return view('home', compact('beritas', 'galeris'));
})->name('home');

// Route untuk halaman pending verifikasi
Route::get('/pending', [UserController::class, 'pending'])->name('pending');


// Halaman statis
// Halaman publik berita tanpa middleware
Route::get('/berita', [BeritaController::class, 'publicIndex'])->name('berita.publicIndex');
Route::get('/berita/{id}', [BeritaController::class, 'publicShow'])->name('berita.show');
Route::get('/pengurus', [PengurusController::class, 'publicIndex'])->name('pengurus.index');
Route::view('/tentangdmi', 'tentangdmi.index');

// Tampilan daftar masjid untuk umum
Route::get('/masjid', [MasjidController::class, 'index'])->name('datamasjid.index');
Route::get('/masjids/{id}', [MasjidController::class, 'show'])->name('datamasjid.show');

Route::get('/galeri', [GaleriController::class, 'galeri'])->name('galeri.index');

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
    Route::resource('pengurus', PengurusController::class)->only(['index', 'store', 'destroy']);
    Route::resource('galeri', GaleriController::class)->only(methods: ['index', 'create', 'store', 'destroy']);
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


    // Tampilkan daftar masjid (Kelola Masjid & Admin)

    // Masjid CRUD
    Route::get('/masjids', [AdminController::class, 'index'])->name('masjids.index');
    Route::get('/masjids/create', [AdminController::class, 'create'])->name('masjids.create');
    Route::post('/masjids', [AdminController::class, 'store'])->name('masjids.store');
    Route::get('/masjids/{id}/edit', [AdminController::class, 'edit'])->name('masjids.edit');
    Route::put('/masjids/{id}', [AdminController::class, 'update'])->name('masjids.update');
    Route::delete('/masjids/{id}', [AdminController::class, 'destroy'])->name('masjids.destroy');

    // Ganti Password
    Route::get('/change-password', [AdminController::class, 'showChangePasswordForm'])->name('password.change.form');
    Route::post('/change-password', [AdminController::class, 'changePassword'])->name('password.change');
});
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard admin
    Route::get('/dashboard', [AdminController::class, 'adminIndex'])->name('dashboard');


    // Edit masjid
    Route::get('/masjids/{id}/edit', [AdminController::class, 'edit'])->name('masjids.edit');
    Route::put('/masjids/{id}', [AdminController::class, 'update'])->name('masjids.update');

    // Hapus masjid
    Route::delete('/masjids/{id}', [AdminController::class, 'destroy'])->name('masjids.destroy');

    // Ganti Password
    Route::get('/change-password', [AdminController::class, 'showChangePasswordForm'])->name('password.change.form');
    Route::post('/change-password', [AdminController::class, 'changePassword'])->name('password.change');
});

// Route untuk galeri publik
Route::prefix('galeri')->name('galeri.')->group(function () {
    Route::get('/', [GaleriController::class, 'galeri'])->name('index');
    Route::get('/search', [GaleriController::class, 'search'])->name('search');
});

// Route untuk pencarian data masjid publik
Route::prefix('datamasjid')->name('datamasjid.')->group(function () {
    Route::get('/search', [MasjidController::class, 'search'])->name('search');
});





