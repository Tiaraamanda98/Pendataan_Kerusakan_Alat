<?php

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
})->name('welcome');

use App\Http\Controllers\AuthController;
// Login & Logout (umum untuk semua role)
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Login Teknisi
Route::get('/login-teknisi', [AuthController::class, 'loginFormTeknisi'])->name('teknisi.login.form');
Route::post('/login-teknisi', [AuthController::class, 'loginTeknisi'])->name('teknisi.login');


// Registrasi SMK
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// Registrasi Teknisi
Route::get('/register-teknisi', [AuthController::class, 'registerTeknisiForm'])->name('register.teknisi');
Route::post('/register-teknisi', [AuthController::class, 'registerTeknisi'])->name('register.teknisi.submit');

use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');



Route::get('/profile', function () {
    return view('profile');
})->name('profile'); 

use App\Http\Controllers\ProfileController;

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');



use App\Http\Controllers\UserController;

 
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');


use App\Http\Controllers\KlienController;

    Route::get('kliens', [KlienController::class, 'index'])->name('kliens.index');
    Route::get('kliens/create', [KlienController::class, 'create'])->name('kliens.create');
    Route::post('kliens', [KlienController::class, 'store'])->name('kliens.store'); 
    Route::get('/kliens/{id}', [KlienController::class, 'show'])->name('kliens.show'); 

    Route::put('kliens/{klien}', [KlienController::class, 'update'])->name('kliens.update');
    Route::get('kliens/{klien}/edit', [KlienController::class, 'edit'])->name('kliens.edit');
    Route::delete('kliens/{klien}', [KlienController::class, 'destroy'])->name('kliens.destroy');
    Route::get('/kliens/siswa/create', [KlienController::class, 'createSiswa'])->name('kliens.siswa.create');
    Route::get('/generate-id/{instansi}', [KlienController::class, 'generateIdByInstansi']);



    use App\Http\Controllers\QrCodeController;
    Route::get('/qr', [QrCodeController::class, 'show'])->name('qr.show');
    



Route::get('/pengaduan/baru', [DashboardController::class, 'pengaduanBaru'])->name('pengaduan.baru');
Route::get('/pengaduan/diproses', [DashboardController::class, 'pengaduanDiproses'])->name('pengaduan.diproses');
Route::get('/pengaduan/selesai', [DashboardController::class, 'pengaduanSelesai'])->name('pengaduan.selesai');
    


use App\Http\Controllers\ExportController;
Route::get('/riwayat', [KlienController::class, 'riwayat'])->name('kliens.riwayat');
Route::get('/export-riwayat', [ExportController::class, 'export'])->name('kliens.export');

use App\Http\Controllers\RiwayatController;
Route::get('/riwayat/cetak-pdf', [RiwayatController::class, 'cetakPdf'])->name('riwayat.cetak-pdf');


use App\Http\Controllers\TeknisiController; 
Route::get('teknisis', [TeknisiController::class, 'index'])->name('teknisis.index');
Route::get('teknisis/create', [TeknisiController::class, 'create'])->name('teknisis.create');
Route::post('teknisis', [TeknisiController::class, 'store'])->name('teknisis.store');
Route::put('teknisis/{teknisi}', [TeknisiController::class, 'update'])->name('teknisis.update');
Route::get('teknisis/{teknisi}/edit', [TeknisiController::class, 'edit'])->name('teknisis.edit');
Route::delete('teknisis/{teknisi}', [TeknisiController::class, 'destroy'])->name('teknisis.destroy');


use App\Http\Controllers\CoverController; 
Route::get('covers', [CoverController::class, 'index'])->name('covers.index');
Route::get('covers/create', [CoverController::class, 'create'])->name('covers.create');
Route::post('covers', [CoverController::class, 'store'])->name('covers.store');
Route::put('covers/{cover}', [CoverController::class, 'update'])->name('covers.update');
Route::get('covers/{cover}/edit', [CoverController::class, 'edit'])->name('covers.edit');
Route::delete('covers/{cover}', [CoverController::class, 'destroy'])->name('covers.destroy');


