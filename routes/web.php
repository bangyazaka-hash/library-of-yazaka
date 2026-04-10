<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// ====================
// ADMIN
// ====================
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\BukuController;
use App\Http\Controllers\Admin\AnggotaController;
use App\Http\Controllers\Admin\PeminjamanController;

// ====================
// SISWA
// ====================
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboardController;
use App\Http\Controllers\Siswa\PeminjamanController as SiswaPeminjamanController;
use App\Http\Controllers\Siswa\PengembalianController as SiswaPengembalianController;
use App\Http\Controllers\Siswa\BukuController as SiswaBukuController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect root ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// ====================
// AUTH
// ====================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ====================
// ADMIN
// ====================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // CRUD Buku
    Route::resource('/buku', BukuController::class)->except(['show']);

    // CRUD Anggota
    Route::resource('/anggota', AnggotaController::class)
        ->parameters(['anggota' => 'anggota'])
        ->except(['show']);

    // CRUD Peminjaman
    Route::resource('/peminjaman', PeminjamanController::class)
        ->parameters(['peminjaman' => 'peminjaman'])
        ->except(['show', 'edit', 'update']);

    // Pengembalian (Admin)
    Route::put('/peminjaman/{peminjaman}/kembalikan', [PeminjamanController::class, 'kembalikan'])
        ->name('peminjaman.kembalikan');
});

// ====================
// SISWA
// ====================
Route::middleware(['auth', 'siswa'])->prefix('siswa')->name('siswa.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [SiswaDashboardController::class, 'index'])->name('dashboard');

    // ====================
    // 📚 PINJAM BUKU ONLINE (BARU)
    // ====================
    Route::get('/buku', [SiswaBukuController::class, 'index'])
        ->name('buku.index');

    Route::post('/buku/{buku}/pinjam', [SiswaBukuController::class, 'pinjam'])
        ->name('buku.pinjam');

    // ====================
    // 📖 RIWAYAT PEMINJAMAN
    // ====================
    Route::get('/peminjaman', [SiswaPeminjamanController::class, 'index'])
        ->name('peminjaman.index');

    // ====================
    // 📦 RIWAYAT PENGEMBALIAN
    // ====================
    Route::get('/pengembalian', [SiswaPengembalianController::class, 'index'])
        ->name('pengembalian.index');
});