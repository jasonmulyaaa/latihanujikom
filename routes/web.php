<?php

use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TanggapanController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\VerifikasiController;
use App\Http\Controllers\ValidasiController;
use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/panel', [LoginController::class, 'index'])->name('panel')->middleware('guest:petugas');
Route::post('/panel', [LoginController::class, 'authentication'])->name('authentication');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/login', [LoginUserController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginUserController::class, 'authenticate'])->name('authenticate');
Route::get('logout', [LoginUserController::class, 'logout'])->name('logout');

Route::resource('usermanagement', UserManagementController::class)->middleware(['auth:petugas','admin'], 'auth:masyarakat');
Route::resource('dashboard', DashboardController::class);
Route::resource('tanggapan', TanggapanController::class)->middleware('auth:petugas');
Route::resource('verifikasi', VerifikasiController::class)->middleware('auth:petugas');
Route::resource('validasi', ValidasiController::class)->middleware('auth:petugas');

Route::get('/pdf', [PDFController::class, 'generatepdf'])->name('pdf');

Route::resource('welcome', HomepageController::class);
Route::resource('register', RegisterController::class);
Route::resource('pengaduan', PengaduanController::class)->middleware('auth:masyarakat');;
