<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BarangController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PengajuannController;
use App\Http\Controllers\PengembalianController;

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

Route::middleware('auth', 'role:Admin')->prefix('admin')->group(function () {
    Route::get('/peminjaman', [AdminController::class, 'peminjaman'])->name('admin.peminjaman');
    Route::get('/pengembalian', [AdminController::class, 'pengembalian'])->name('admin.pengembalian');
    Route::post('/peminjaman/{id}/approve', [AdminController::class, 'approve'])->name('admin.peminjaman.approve');
    Route::post('/peminjaman/{id}/reject', [AdminController::class, 'reject'])->name('admin.peminjaman.reject');
});

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);    
    Route::resource('barang', BarangController::class);
});

Route::middleware('auth')->group(function () {
    // Route::resource('/peminjaman', [PengajuanController::class, 'index'])->name('peminjaman');
    Route::resource('pengajuann', PengajuannController::class);
    Route::resource('pengembalian', PengembalianController::class);
});
