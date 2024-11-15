<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PembimbingController;
use App\Http\Controllers\MentorController;


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
    Route::get('/absen', [AdminController::class, 'absenIndex'])->name('admin.absen.index'); // Menampilkan daftar absen
    Route::get('/absen/create', [AdminController::class, 'absenCreate'])->name('admin.absen.create'); // Form untuk membuat absen baru
    Route::post('/absen', [AdminController::class, 'absenStore'])->name('admin.absen.store'); // Menyimpan absen baru
    Route::get('/absen/{id}/edit', [AdminController::class, 'absenEdit'])->name('admin.absen.edit'); // Form edit absen
    Route::put('/absen/{id}', [AdminController::class, 'absenUpdate'])->name('admin.absen.update'); // Mengupdate absen
    Route::delete('/absen/{id}', [AdminController::class, 'absenDelete'])->name('admin.absen.delete'); // Menghapus absen

    // Route untuk CRUD data Kegiatan Harian
    Route::get('/kegiatan', [AdminController::class, 'kegiatanIndex'])->name('admin.kegiatan.index'); // Menampilkan daftar kegiatan
    Route::get('/kegiatan/create', [AdminController::class, 'kegiatanCreate'])->name('admin.kegiatan.create'); // Form untuk membuat kegiatan baru
    Route::post('/kegiatan', [AdminController::class, 'kegiatanStore'])->name('admin.kegiatan.store'); // Menyimpan kegiatan baru
    Route::get('/kegiatan/{id}/edit', [AdminController::class, 'kegiatanEdit'])->name('admin.kegiatan.edit'); // Form edit kegiatan
    Route::put('/kegiatan/{id}', [AdminController::class, 'kegiatanUpdate'])->name('admin.kegiatan.update'); // Mengupdate kegiatan
    Route::delete('/kegiatan/{id}', [AdminController::class, 'kegiatanDelete'])->name('admin.kegiatan.delete'); // Menghapus kegiatan
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
    Route::get('/siswa/riwayat-kegiatan', [SiswaController::class, 'kegiatan'])->name('siswa.riwayat-kegiatan');
    Route::get('/siswa/kegiatan/create', [SiswaController::class, 'create'])->name('siswa.kegiatan.create');
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

//route mentor
Route::middleware(['auth', CheckRole::class . ':mentor'])->group(function () {
    Route::get('/mentor/beranda', [MentorController::class, 'index'])->name('mentor.beranda');

Route::get('/kegiatan', [MentorController::class, 'index']);
Route::get('/kegiatansiswa', [MentorController::class, 'kegiatanSiswa'])->name('mentor.kegiatansiswa');
Route::get('/kegiatan/{id}', [MentorController::class, 'detailKegiatan'])->name('mentor.detailKegiatan');
Route::get('/mentor/absen', [MentorController::class, 'absenIndex'])->name('mentor.absenIndex');
});
