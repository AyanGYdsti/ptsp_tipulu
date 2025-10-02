<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Pelayanan;
use App\Models\Pengajuan;
use App\Models\Masyarakat;
use App\Models\Aparatur;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $title = "Dashboard";

        $jumlahPelayanan = Pelayanan::count();
        $jumlahPengajuan = Pengajuan::count();
        $jumlahMasyarakat = Masyarakat::count();
        $jumlahAparatur = Aparatur::count();

        return view('backend.dashboard.index', compact('title', 'jumlahPelayanan', 'jumlahPengajuan', 'jumlahMasyarakat', 'jumlahAparatur'));
    }
}
