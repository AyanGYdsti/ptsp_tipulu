<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Frontend\BerandaController;
use App\Http\Controllers\PersyaratanController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [BerandaController::class, 'index'])->name('beranda');
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'authLogin'])->name('auth.login');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/persyaratan', [PersyaratanController::class, 'index'])->name('persyaratan');
Route::get('/persyaratan/edit/{id}', [PersyaratanController::class, 'edit'])->name('persyaratan.edit');
Route::post('/persyaratan/store', [PersyaratanController::class, 'store'])->name('persyaratan.store');
Route::put('/persyaratan/update/{id}', [PersyaratanController::class, 'update'])->name('persyaratan.update');
Route::get('/persyaratan/delete/{id}', [PersyaratanController::class, 'delete'])->name('persyaratan.delete');
