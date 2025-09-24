<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Backend\AparaturController;
use App\Http\Controllers\Backend\BeritaController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\LandingPageController;
use App\Http\Controllers\Frontend\BerandaController;
use App\Http\Controllers\Backend\PersyaratanController;
use App\Http\Controllers\Backend\PelayananController;
use App\Http\Controllers\Frontend\DetailBeritaController;
use App\Http\Controllers\Frontend\ListpelayananController as FrontendListpelayananController;
use App\Http\Controllers\Frontend\MasyarakatController;
use App\Http\Controllers\Frontend\PengajuanController;
use App\Http\Controllers\ListpelayananController;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/surat', function () {
    // load view
    $pdf = Pdf::loadView('backend.surat.template-surat', [
        'judul' => 'Surat Keterangan',
        'tahun' => now()->format('-Y'),
        'tanggal' => now()->format('d-m-Y'),
    ]);


    // atau tampilkan di browser
    return $pdf->stream('surat.pdf');
});
Route::get('/', [BerandaController::class, 'index'])->name('beranda');
Route::get('/detail-berita/{id}', [DetailBeritaController::class, 'index'])->name('detail-berita');
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

Route::get('/berita', [BeritaController::class, 'index'])->name('berita');
Route::get('/berita/edit/{id}', [BeritaController::class, 'edit'])->name('berita.edit');
Route::post('/berita/store', [BeritaController::class, 'store'])->name('berita.store');
Route::put('/berita/update/{id}', [BeritaController::class, 'update'])->name('berita.update');
Route::get('/berita/delete/{id}', [BeritaController::class, 'delete'])->name('berita.delete');

Route::get('/landing-page', [LandingPageController::class, 'index'])->name('landing-page');
Route::post('/landing-page/store', [LandingPageController::class, 'store'])->name('landing-page.store');

Route::get('/list-pelayanan', [FrontendListpelayananController::class, 'index'])->name('list-pelayanan');

Route::get('/aparatur', [AparaturController::class, 'index'])->name('aparatur');
Route::get('/aparatur/edit/{id}', [AparaturController::class, 'edit'])->name('aparatur.edit');
Route::post('/aparatur/store', [AparaturController::class, 'store'])->name('aparatur.store');
Route::put('/aparatur/update/{id}', [AparaturController::class, 'update'])->name('aparatur.update');
Route::get('/aparatur/delete/{id}', [AparaturController::class, 'delete'])->name('aparatur.delete');

Route::get('/pengajuan/{id}', [PengajuanController::class, 'index'])->name('pengajuan');
Route::post('/pengajuan/cek/{id}', [PengajuanController::class, 'cek'])->name('pengajuan.cek');
Route::post('/pengajuan/store/{id}', [PengajuanController::class, 'store'])->name('pengajuan.store');
Route::get('/pengajuan/detail/{id}/{nik}', [PengajuanController::class, 'detail'])->name('pengajuan.detail');

Route::get('/masyarakat/{id?}/{nik?}', [MasyarakatController::class, 'index'])->name('masyarakat');
Route::post('/masyarakat/store/{id?}', [MasyarakatController::class, 'store'])->name('masyarakat.store');
