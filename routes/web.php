<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\LandingPageController;
use App\Http\Controllers\Frontend\BerandaController;
use App\Http\Controllers\Backend\PersyaratanController;
use App\Http\Controllers\Backend\PelayananController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [BerandaController::class, 'index'])->name('beranda');
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'authLogin'])->name('auth.login');
Route::get('/logout', [AuthController::class, 'authLogout'])->name('auth.logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/persyaratan', [PersyaratanController::class, 'index'])->name('persyaratan');
Route::get('/persyaratan/edit/{id}', [PersyaratanController::class, 'edit'])->name('persyaratan.edit');
Route::post('/persyaratan/store', [PersyaratanController::class, 'store'])->name('persyaratan.store');
Route::put('/persyaratan/update/{id}', [PersyaratanController::class, 'update'])->name('persyaratan.update');
Route::get('/persyaratan/delete/{id}', [PersyaratanController::class, 'delete'])->name('persyaratan.delete');
Route::get('/persyaratan', [PersyaratanController::class, 'index'])->name('persyaratan');

Route::get('/pelayanan', [PelayananController::class, 'index'])->name('pelayanan');
Route::get('/pelayanan/edit/{id}', [PelayananController::class, 'edit'])->name('pelayanan.edit');
Route::post('/pelayanan/store', [PelayananController::class, 'store'])->name('pelayanan.store');
Route::put('/pelayanan/update/{id}', [PelayananController::class, 'update'])->name('pelayanan.update');
Route::get('/pelayanan/delete/{id}', [PelayananController::class, 'delete'])->name('pelayanan.delete');

Route::get('/landing-page', [LandingPageController::class, 'index'])->name('landing-page');
Route::post('/landing-page/store', [LandingPageController::class, 'store'])->name('landing-page.store');
