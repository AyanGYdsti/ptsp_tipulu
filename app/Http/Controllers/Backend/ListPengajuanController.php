<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Aparatur;
use App\Models\DokumenPersyaratan;
use App\Models\Pengajuan;
use App\Models\Persyaratan;
use App\Models\Verifikasi;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class ListPengajuanController extends Controller
{
    public function index()
    {
        $title = "List Pengajuan";

        $pengajuan = Pengajuan::with(['pelayanan', 'dokumenPersyaratan.persyaratan'])->orderByDesc('id')->get();

        $aparaturs = Aparatur::get(['id', 'nama']);

        return view('backend.list-pengajuan.index', compact('title', 'pengajuan', 'aparaturs'));
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

    public function cetak(Request $request, $id)
    {
        $pengajuan = Pengajuan::with(['pelayanan', 'dokumenPersyaratan.persyaratan'])->find($id);

        $pdf = Pdf::loadView('backend.surat.template-surat', [
            'judul' => $pengajuan->pelayanan->nama,
            'tahun' => Carbon::parse($request->tgl_cetak)->format('Y'),
            'tanggal' => Carbon::parse($request->tgl_cetak)->format('d-m-Y'),
        ]);


        // atau tampilkan di browser
        return $pdf->stream('surat.pdf');
    }

    public function stream($persyaratan_id, $pengajuan_id)
    {
        $path = DokumenPersyaratan::where('persyaratan_id', $persyaratan_id)
            ->where('pengajuan_id', $pengajuan_id)
            ->value('dokumen');

        $persyaratan = Persyaratan::find($persyaratan_id);

        $fullPath = public_path($path);

        if (!file_exists($fullPath)) {
            abort(404, 'File tidak ditemukan.');
        }

        $filename = $persyaratan->nama . '.pdf'; // ✅ kasih nama tab

        return response()->file($fullPath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename . '"',
        ]);
    }
}
