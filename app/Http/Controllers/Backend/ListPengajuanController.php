<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use App\Models\Verifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListPengajuanController extends Controller
{
    public function index()
    {
        $title = "List Pengajuan";

        $pengajuan = Pengajuan::with(['masyarakat.dokumenPersyaratan', 'pelayanan'])->get();

        return view('backend.list-pengajuan.index', compact('title', 'pengajuan'));
    }

    public function verifikasi($id)
    {
        try {
            Verifikasi::create([
                'pengajuan_id' => $id,
                'status' => 'Diverifikasi oleh ' . Auth::user()->username,
                'aparatur_id' => 4,
            ]);

            return back()->with('success', 'Berhasil verifikasi data');
        } catch (\Throwable $th) {
            return back()->with('error', 'Gagal verifikasi data');
        }
    }
}
