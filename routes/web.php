<?php

use App\Http\Controllers\Frontend\BerandaController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [BerandaController::class, 'index'])->name('beranda');
