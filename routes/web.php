<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BarangController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

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
  
Route::group(['middleware' => ['auth']], function() {
    Route::get('/admin/peminjaman', [AdminController::class, 'peminjaman'])->name('admin.peminjaman');
    Route::get('/admin/pengembalian', [AdminController::class, 'pengembalian'])->name('admin.pengembalian');

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);    
    Route::resource('barang', BarangController::class);
});
