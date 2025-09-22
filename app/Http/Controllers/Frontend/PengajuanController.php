<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Masyarakat;
use App\Models\Pelayanan;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    public function index($id)
    {
        $title = "Pengajuan";

        return view('frontend.pengajuan.index', compact('title', 'id'));
    }

    public function cek(Request $request, $id)
    {
        $nik = Masyarakat::where('nik', $request->nik)->value('nik');
        if (!$nik) {
            return redirect()->route('masyarakat', ['id' => $id, 'nik' => $request->nik]);
        }

        return redirect()->route('pengajuan.detail', compact('id', 'nik'));
    }

    public function detail($id, $nik)
    {
        $title = "Pengajuan Detail";

        $masyarakat = Masyarakat::where('nik', $nik)->first();

        $pelayanan = Pelayanan::with('pelayananPersyaratan.persyaratan')->where('id', $id)->first();

        return view('frontend.pengajuan.detail', compact('title', 'masyarakat', 'pelayanan'));
    }
}
