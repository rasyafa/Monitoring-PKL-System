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
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    //Route untuk manajemen user
    Route::get('/users', [AdminController::class, 'manageUsers'])->name('admin.users.index');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');

    // Route untuk CRUD data Absen
    Route::get('/admin/absen', [AdminController::class, 'absenIndex'])->name('admin.absen.index'); // Menampilkan daftar absen

    // Route untuk CRUD data Kegiatan Harian
    Route::get('/kegiatan', [AdminController::class, 'kegiatanIndex'])->name('admin.kegiatan.index'); // Menampilkan daftar siswa
    Route::get('/kegiatan/{id}', [AdminController::class, 'kegiatanShow'])->name('admin.kegiatan.show'); // Menampilkan kegiatan siswa yang dipilih
    Route::post('/kegiatan/{id}/validasi', [AdminController::class, 'validasiKegiatan'])->name('admin.kegiatan.acc');
});


//ROUTE SISWA
// BERANDA SISWA
Route::middleware(['auth', CheckRole::class . ':siswa'])->group(function () {
    Route::get('/siswa/beranda', [SiswaController::class, 'index'])->name('siswa.beranda');

    // PROFILE SISWA
    Route::get('profil/{id}', [SiswaController::class, 'show'])->name('siswa.show');
    Route::get('profil/{id}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
    Route::put('profil/{id}', [SiswaController::class, 'update'])->name('siswa.update');

    // ABSEN SISWA
    Route::get('/absen', [SiswaController::class, 'absenIndex'])->name('siswa.absen');
    Route::post('/absen', [SiswaController::class, 'absenStore'])->name('siswa.absen.store');

    // KEGIATAN HARIAN SISWA
    Route::get('/riwayat-kegiatan', [SiswaController::class, 'kegiatan'])->name('siswa.riwayat-kegiatan');
    Route::get('/kegiatan/create', [SiswaController::class, 'create'])->name('siswa.kegiatan.create');
    Route::post('/kegiatan', [SiswaController::class, 'store'])->name('siswa.kegiatan.store');
});


//route pembimbing
Route::middleware(['auth', CheckRole::class . ':pembimbing'])->group(function () {
    Route::get('/pembimbing/home', [PembimbingController::class, 'index'])->name('pembimbing.home');

    // Route untuk monitoring
    Route::get('/pembimbing/kegiatan', [PembimbingController::class, 'indexkegiatan'])->name('pembimbing.monitoring');

    Route::get('/monitoring', [PembimbingController::class, 'indexkegiatan'])->name('monitoring');
    Route::get('/monitoring/create', [PembimbingController::class, 'create'])->name('pembimbing.create');
    Route::post('/monitoring/store', [PembimbingController::class, 'store'])->name('pembimbing.store');
    Route::get('/pembimbing/absen', [PembimbingController::class, 'absenIndex'])->name('pembimbing.absen');
});

