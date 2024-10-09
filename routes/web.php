<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BarangController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\PengembalianController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
  
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Route Admin
Route::middleware('auth', 'role:Admin')->prefix('admin')->group(function () {
    Route::resource('barang', BarangController::class);
    Route::get('/peminjaman', [AdminController::class, 'peminjaman'])->name('admin.peminjaman');
    Route::get('/peminjaman/habispakai', [AdminController::class, 'peminjamanhp'])->name('admin.peminjamanhp');
    Route::get('/peminjaman/tidakhabispakai', [AdminController::class, 'peminjamanthp'])->name('admin.peminjamanthp');
    Route::get('/pengembalian', [AdminController::class, 'pengembalian'])->name('admin.pengembalian');
    Route::post('/peminjaman/{id}/approve', [AdminController::class, 'approve'])->name('admin.peminjaman.approve');
    Route::delete('/peminjaman/{id}', [AdminController::class, 'hapuspengajuan'])->name('admin.peminjaman.hapuspeminjaman');
    Route::delete('/pengembalian/{id}', [AdminController::class, 'hapuspengembalian'])->name('admin.pengembalian.hapuspengembalian');
    Route::post('/peminjaman/{id}/reject', [AdminController::class, 'reject'])->name('admin.peminjaman.reject');
    Route::post('/pengembalian/{id}/approve', [AdminController::class, 'approvepengembalian'])->name('admin.pengembalian.approve');
    Route::post('/pengembalian/{id}/reject', [AdminController::class, 'rejectpengembalian'])->name('admin.pengembalian.reject');
    // Rekap Laporan
    Route::get('/laporan/peminjaman', [LaporanController::class, 'laporanPeminjaman'])->name('admin.laporan.peminjaman');
    Route::get('/laporan/pengembalian', [LaporanController::class, 'laporanPengembalian'])->name('admin.laporan.pengembalian');
    
    // Cetak Laporan
    Route::get('/laporan/peminjaman/cetak-pdf', [LaporanController::class, 'cetakLaporanPeminjamanPDF'])->name('admin.laporan.peminjaman.pdf');
    Route::get('/laporan/pengembalian/cetak-pdf', [LaporanController::class, 'cetakLaporanPengembalianPDF'])->name('admin.laporan.pengembalian.pdf');

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});

Route::middleware('auth', 'role:Siswa|Guru|Karyawan')->group(function () {
    Route::resource('pengajuan', PengajuanController::class);
    Route::resource('pengembalian', PengembalianController::class);
});
