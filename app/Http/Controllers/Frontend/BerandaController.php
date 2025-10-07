<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\LandingPage;
use App\Models\Pelayanan;
use App\Models\Aparatur;
use App\Models\Berita;
use App\Models\Masyarakat; // Tambahkan ini
use Illuminate\Http\Request;
use Carbon\Carbon; // Tambahkan ini untuk mempermudah perhitungan usia

class BerandaController extends Controller
{
    public function index()
    {
        // Ambil data-data statis seperti biasa
        $landingPage = LandingPage::first();
        $pelayanan = Pelayanan::whereIn('id', [7, 10, 13])->get();
        $aparatur = Aparatur::orderBy('posisi', 'asc')->paginate(4);
        $berita = Berita::latest()->limit(6)->get();

        // -------------------------------------------------------------
        // Logika untuk mengambil data demografi dari tabel masyarakats
        // -------------------------------------------------------------
        $totalPenduduk = Masyarakat::count();

        // Data Jenis Kelamin
        $totalLakiLaki = Masyarakat::where('jk', 'Laki-laki')->count();
        $totalPerempuan = Masyarakat::where('jk', 'Perempuan')->count();

        // Data Kelompok Usia
        $usiaBalita = Masyarakat::whereBetween('tgl_lahir', [Carbon::now()->subYears(5), Carbon::now()])->count();
        $usiaAnak = Masyarakat::whereBetween('tgl_lahir', [Carbon::now()->subYears(12)->subDay(), Carbon::now()->subYears(6)])->count();
        $usiaRemaja = Masyarakat::whereBetween('tgl_lahir', [Carbon::now()->subYears(17)->subDay(), Carbon::now()->subYears(13)])->count();
        $usiaDewasa = Masyarakat::whereBetween('tgl_lahir', [Carbon::now()->subYears(59)->subDay(), Carbon::now()->subYears(18)])->count();
        $usiaLansia = Masyarakat::whereDate('tgl_lahir', '<=', Carbon::now()->subYears(60))->count();

        return view('frontend.beranda.index', [
            'landingPage' => $landingPage,
            'pelayanan' => $pelayanan,
            'aparatur' => $aparatur,
            'berita' => $berita,
            'totalPenduduk' => $totalPenduduk,
            'totalLakiLaki' => $totalLakiLaki,
            'totalPerempuan' => $totalPerempuan,
        ]);
    }
}
