<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PembimbingController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// routes admin
Route::middleware(['auth', CheckRole::class . ':admin'])->prefix('admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    //Route untuk manajemen user
    Route::get('/admin/users', [AdminController::class, 'manageUsers'])->name('admin.users.index');
    Route::get('/admin/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
    Route::post('/admin/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');

    //Route untuk Manajemen Absen
    Route::get('/absensi', [AdminController::class, 'manageAbsensi'])->name('admin.absensi.index');
    Route::get('/absensi/create', [AdminController::class, 'createAbsensi'])->name('admin.absensi.create');
    Route::post('/absensi', [AdminController::class, 'storeAbsensi'])->name('admin.absensi.store');
    Route::get('/absensi/{absensi}/edit', [AdminController::class, 'editAbsensi'])->name('admin.absensi.edit');
    Route::put('/absensi/{absensi}', [AdminController::class, 'updateAbsensi'])->name('admin.absensi.update');
    Route::delete('/absensi/{absensi}', [AdminController::class, 'deleteAbsensi'])->name('admin.absensi.delete');

    //Route untuk Manajemen Log-Book
    Route::get('/kegiatan', [AdminController::class, 'manageKegiatan'])->name('admin.kegiatan.index');
    Route::get('/kegiatan/create', [AdminController::class, 'createKegiatan'])->name('admin.kegiatan.create');
    Route::post('/kegiatan', [AdminController::class, 'storeKegiatan'])->name('admin.kegiatan.store');
    Route::get('/kegiatan/{id}/edit', [AdminController::class, 'editKegiatan'])->name('admin.kegiatan.edit');
    Route::put('/kegiatan/{id}', [AdminController::class, 'updateKegiatan'])->name('admin.kegiatan.update');
    Route::delete('/kegiatan/{id}', [AdminController::class, 'deleteKegiatan'])->name('admin.kegiatan.delete');
});


//route siswa
Route::middleware(['auth', CheckRole::class . ':siswa'])->group(function () {
    Route::get('/siswa/beranda', [SiswaController::class, 'index'])->name('siswa.beranda');
});
// route untuk absen siswa
Route::middleware(['auth', CheckRole::class . ':siswa'])->group(function () {
    Route::get('/absen', [SiswaController::class, 'absenIndex'])->name('siswa.absen');
    Route::post('/absen', [SiswaController::class, 'absenStore'])->name('siswa.absen.store');
});

Route::middleware(['auth', CheckRole::class . ':siswa'])->group(function () {
    // Route untuk menampilkan riwayat kegiatan
    Route::get('/siswa/riwayat-kegiatan', [SiswaController::class, 'kegiatan'])->name('siswa.riwayat-kegiatan');

    // Route untuk menampilkan halaman tambah kegiatan
    Route::get('/siswa/kegiatan/create', [SiswaController::class, 'create'])->name('siswa.kegiatan.create'); // <-- Pastikan ada route ini

    // Route untuk menyimpan kegiatan baru
    Route::post('/siswa/kegiatan', [SiswaController::class, 'store'])->name('siswa.kegiatan.store');
});

//route pembimbing
Route::middleware(['auth', CheckRole::class . ':pembimbing'])->group(function () {
    Route::get('/pembimbing/home', [PembimbingController::class, 'index'])->name('pembimbing.home');

    // Route untul monitoring
    Route::get('/pembimbing/kegiatan', [PembimbingController::class, 'indexkegiatan'])->name('pembimbing.monitoring');
    Route::get('/pembimbing/kegiatan/create', [PembimbingController::class, 'create'])->name('pembimbing.create');
    Route::post('/pembimbing/kegiatan', [PembimbingController::class, 'store'])->name('pembimbing.store');
});


