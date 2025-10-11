<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Backend\AparaturController;
use App\Http\Controllers\Backend\BeritaController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\LandingPageController;
use App\Http\Controllers\Backend\ListPengajuanController;
use App\Http\Controllers\Backend\PersyaratanController;
use App\Http\Controllers\Backend\PelayananController;
use App\Http\Controllers\Backend\MasyarakatController;
use App\Http\Controllers\Frontend\BerandaController;
use App\Http\Controllers\Frontend\DetailBeritaController;
use App\Http\Controllers\Frontend\ListpelayananController as FrontendListpelayananController;
use App\Http\Controllers\Frontend\PengajuanController;
use App\Http\Controllers\Frontend\ListaparaturController;
use App\Http\Controllers\ListpelayananController;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\PermohonanController;
use App\Http\Controllers\Api\FcmController;
use App\Http\Controllers\Frontend\DetailAparaturController;
use App\Models\Pengajuan;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route tanpa middleware (public)
Route::get('/', [BerandaController::class, 'index'])->middleware('throttle:30,1')->name('beranda');
Route::get('/detail-berita/{id}', [DetailBeritaController::class, 'index'])->middleware('throttle:30,1')->name('detail-berita');
Route::get('/login', [AuthController::class, 'index'])->middleware('throttle:30,1')->name('login');
Route::post('/login', [AuthController::class, 'authLogin'])->middleware('throttle:30,1')->name('auth.login');

Route::get('/detail-aparatur', [ListAparaturController::class, 'index'])->middleware('throttle:30,1')->name('detail-aparatur');

Route::get('/landing-page', [LandingPageController::class, 'index'])->middleware('throttle:30,1')->name('landing-page');
Route::post('/landing-page/store', [LandingPageController::class, 'store'])->middleware('throttle:30,1')->name('landing-page.store');
Route::get('/sejarah', [LandingPageController::class, 'detailSejarah'])->middleware('throttle:30,1')->name('sejarah');
Route::get('/visimisi', [LandingPageController::class, 'detailVisiMisi'])->middleware('throttle:30,1')->name('visimisi');

Route::get('/list-aparatur', [ListaparaturController::class, 'index'])->middleware('throttle:30,1')->name('frontend.aparatur.index');
Route::get('/list-pelayanan', [FrontendListpelayananController::class, 'index'])->middleware('throttle:30,1')->name('list-pelayanan');
Route::get('/pengajuan/{id}', [PengajuanController::class, 'index'])->middleware('throttle:30,1')->name('pengajuan');
Route::match(['get', 'post'], '/pengajuan/cek/{id}', [PengajuanController::class, 'cek'])->middleware('throttle:30,1')->name('pengajuan.cek');

Route::post('/pengajuan/store/{id}', [PengajuanController::class, 'store'])->middleware('throttle:30,1')->name('pengajuan.store');
Route::get('/pengajuan/detail/{id}/{nik?}', [PengajuanController::class, 'detail'])->middleware('throttle:30,1')->name('pengajuan.detail');

// ✅ PINDAHKAN 3 ROUTE INI KELUAR DARI MIDDLEWARE AUTH (untuk mobile app)
// Validasi auth sudah dilakukan di dalam controller
Route::post('/list-pengajuan/{id}/cetak-stream', [ListPengajuanController::class, 'handleCetakStream'])->middleware('throttle:30,1')->name('list-pengajuan.cetak.stream');
Route::post('/list-pengajuan/{id}/cetak-download', [ListPengajuanController::class, 'handleCetakDownload'])->middleware('throttle:30,1')->name('list-pengajuan.cetak.download');
Route::get('/list-pengajuan/stream/{persyaratan_id}/{pengajuan_id}', [ListPengajuanController::class, 'stream'])->middleware('throttle:30,1')->name('list-pengajuan.stream');

// Route dengan middleware auth
Route::middleware(['auth'])->group(function () {
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

    Route::get('/logout', [AuthController::class, 'authLogout'])->middleware('throttle:30,1')->name('auth.logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('throttle:30,1')->name('dashboard');
    Route::get('/pengajuan-surat', [PermohonanController::class, 'index'])->middleware('throttle:30,1')->name('permohonan.index');


    Route::get('/list-pengajuan', [ListPengajuanController::class, 'index'])->middleware('throttle:30,1')->name('list-pengajuan');
    // Route::post('/list-pengajuan/cetak/{id}', [ListPengajuanController::class, 'cetak'])->middleware('throttle:30,1')->name('list-pengajuan.cetak');
    Route::put('/list-pengajuan/verifikasi/{id}', [ListPengajuanController::class, 'verifikasi'])->middleware('throttle:30,1')->name('list-pengajuan.verifikasi');
    // ✅ ROUTE INI SUDAH DIPINDAHKAN KE LUAR (lihat baris 43)
    // Route::get('/list-pengajuan/stream/{persyaratan_id}/{pengajuan_id}', [ListPengajuanController::class, 'stream'])->middleware('throttle:30,1')->name('list-pengajuan.stream');

    Route::get('/list-pengajuan', [ListPengajuanController::class, 'index'])->middleware('throttle:30,1')->name('list-pengajuan');
    Route::post('/list-pengajuan/cetak/{id}', [ListPengajuanController::class, 'cetak'])->middleware('throttle:30,1')->name('list-pengajuan.cetak');
    Route::put('/list-pengajuan/verifikasi/{id}', [ListPengajuanController::class, 'verifikasi'])->middleware('throttle:30,1')->name('list-pengajuan.verifikasi');
    // ✅ ROUTE INI SUDAH DIPINDAHKAN KE LUAR (lihat baris 43)
    // Route::get('/list-pengajuan/stream/{persyaratan_id}/{pengajuan_id}', [ListPengajuanController::class, 'stream'])->middleware('throttle:30,1')->name('list-pengajuan.stream');

    Route::get('/persyaratan', [PersyaratanController::class, 'index'])->middleware('throttle:30,1')->name('persyaratan');
    Route::get('/persyaratan/edit/{id}', [PersyaratanController::class, 'edit'])->middleware('throttle:30,1')->name('persyaratan.edit');
    Route::post('/persyaratan/store', [PersyaratanController::class, 'store'])->middleware('throttle:30,1')->name('persyaratan.store');
    Route::put('/persyaratan/update/{id}', [PersyaratanController::class, 'update'])->middleware('throttle:30,1')->name('persyaratan.update');
    Route::get('/persyaratan/delete/{id}', [PersyaratanController::class, 'delete'])->middleware('throttle:30,1')->name('persyaratan.delete');


    Route::get('/masyarakat', [MasyarakatController::class, 'index'])->middleware('throttle:30,1')->name('masyarakat');
    Route::get('/masyarakat/edit/{id}', [MasyarakatController::class, 'edit'])->middleware('throttle:30,1')->name('masyarakat.edit');
    Route::post('/masyarakat/store', [MasyarakatController::class, 'store'])->middleware('throttle:30,1')->name('masyarakat.store');
    Route::put('/masyarakat/update/{id}', [MasyarakatController::class, 'update'])->middleware('throttle:30,1')->name('masyarakat.update');
    Route::get('/masyarakat/delete/{id}', [MasyarakatController::class, 'delete'])->middleware('throttle:30,1')->name('masyarakat.delete');

    Route::get('/pelayanan', [PelayananController::class, 'index'])->middleware('throttle:30,1')->name('pelayanan');
    Route::get('/pelayanan/edit/{id}', [PelayananController::class, 'edit'])->middleware('throttle:30,1')->name('pelayanan.edit');
    Route::post('/pelayanan/store', [PelayananController::class, 'store'])->middleware('throttle:30,1')->name('pelayanan.store');
    Route::put('/pelayanan/update/{id}', [PelayananController::class, 'update'])->middleware('throttle:30,1')->name('pelayanan.update');
    Route::get('/pelayanan/delete/{id}', [PelayananController::class, 'delete'])->middleware('throttle:30,1')->name('pelayanan.delete');

    Route::get('/berita', [BeritaController::class, 'index'])->middleware('throttle:30,1')->name('berita');
    Route::get('/berita/edit/{id}', [BeritaController::class, 'edit'])->middleware('throttle:30,1')->name('berita.edit');
    Route::post('/berita/store', [BeritaController::class, 'store'])->middleware('throttle:30,1')->name('berita.store');
    Route::put('/berita/update/{id}', [BeritaController::class, 'update'])->middleware('throttle:30,1')->name('berita.update');
    Route::get('/berita/delete/{id}', [BeritaController::class, 'delete'])->middleware('throttle:30,1')->name('berita.delete');




    Route::get('/aparatur', [AparaturController::class, 'index'])->middleware('throttle:30,1')->name('aparatur');
    Route::get('/aparatur/edit/{id}', [AparaturController::class, 'edit'])->middleware('throttle:30,1')->name('aparatur.edit');
    Route::post('/aparatur/store', [AparaturController::class, 'store'])->middleware('throttle:30,1')->name('aparatur.store');
    Route::put('/aparatur/update/{id}', [AparaturController::class, 'update'])->middleware('throttle:30,1')->name('aparatur.update');
    Route::get('/aparatur/delete/{id}', [AparaturController::class, 'delete'])->middleware('throttle:30,1')->name('aparatur.delete');


    // Route ini khusus untuk menerima laporan FCM token dari aplikasi Flutter
    // Route::post('/api/save-fcm-token', [FcmController::class, 'saveToken'])->name('api.save_token');

    Route::post('/fcm/save-token', [FcmController::class, 'saveToken']);

    // // Route untuk STREAM PDF (lihat di browser/mobile)
    // Route::get('/list-pengajuan/stream/{persyaratan_id}/{pengajuan_id}', [ListPengajuanController::class, 'stream'])
    //     ->name('list-pengajuan.stream');

    // // Route untuk CETAK/DOWNLOAD PDF
    // Route::post('/list-pengajuan/cetak/{id}', [ListPengajuanController::class, 'handleCetak'])
    //     ->name('list-pengajuan.cetak');

    // // Route untuk DOWNLOAD (khusus mobile)
    // Route::post('/list-pengajuan/cetak/download/{id}', [ListPengajuanController::class, 'handleCetak'])
    //     ->name('list-pengajuan.cetak.download');

    // ✅ ROUTE INI SUDAH DIPINDAHKAN KE LUAR (lihat baris 41-43)
    // Route::post('/list-pengajuan/{id}/cetak-stream', [ListPengajuanController::class, 'handleCetakStream'])->name('list-pengajuan.cetak.stream');
    // Route::post('/list-pengajuan/{id}/cetak-download', [ListPengajuanController::class, 'handleCetakDownload'])->name('list-pengajuan.cetak.download');
    
    Route::delete('/list-pengajuan/{id}', [ListPengajuanController::class, 'destroy'])->middleware('throttle:30,1')->name('list-pengajuan.destroy');
});