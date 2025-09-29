<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\DokumenPersyaratan;
use App\Models\Masyarakat;
use App\Models\Pelayanan;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PengajuanController extends Controller
{
    public function index($id)
    {
        $title = "Form Cek NIK";

        return view('frontend.pengajuan.index', compact('title', 'id'));
    }

    public function cek(Request $request, $id)
    {
        $nik = Masyarakat::where('nik', $request->nik)->value('nik');
        if (!$nik) {
            return back()->with('error', 'Nik tida ditemukan, Silahkan daftar ke kelurahan tipulu');
        }

        return redirect()->route('pengajuan.detail', ['id' => $id, 'nik' => $nik]);
    }

    public function detail($id, $nik)
    {
        $title = "Pengajuan";

        $masyarakat = Masyarakat::where('nik', $nik)->first();

        $pelayanan = Pelayanan::with('pelayananPersyaratan.persyaratan')->where('id', $id)->first();

        return view('frontend.pengajuan.detail', compact('title', 'masyarakat', 'pelayanan'));
    }

    // File: app/Http/Controllers/Frontend/PengajuanController.php

    public function store(Request $request)
    {
        // 1. TAMBAHKAN VALIDASI UNTUK 'no_wa'
        $data = $request->validate([
            'pelayanan_id' => 'required',
            'nik'          => 'required|exists:masyarakats,nik',
            'no_hp'        => 'required|string|digits_between:10,15', // Wajib diisi, harus angka, 10-15 digit
            'dokumen'      => 'required|array',
            'dokumen.*'    => 'file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        try {
            // 2. CARI DAN UPDATE DATA MASYARAKAT DENGAN NO WA BARU
            // Logika ini dijalankan sebelum membuat pengajuan
            $masyarakat = Masyarakat::where('nik', $data['nik'])->first();


            // --- Sisa logika di bawah ini sama seperti sebelumnya ---
            $pengajuan = Pengajuan::create([
                'nik' => $data['nik'],
                'pelayanan_id' => $data['pelayanan_id'],
                'no_hp' => $data['no_hp']
            ]);

            foreach ($data['dokumen'] as $persyaratanId => $file) {
                if ($request->hasFile("dokumen.$persyaratanId")) {
                    $file = $request->file("dokumen.$persyaratanId");

                    // bikin nama file unik misalnya: nik-persyaratanid-timestamp.ext
                    $filename = $data['nik'] . '-' . $persyaratanId . '-' . time() . '.' . $file->getClientOriginalExtension();

                    // simpan di storage/app/public/dokumen
                    $file->storeAs('public/dokumen', $filename);

                    // path untuk disimpan di database (bisa langsung dipakai dengan asset())
                    $path = 'storage/dokumen/' . $filename;

                    DokumenPersyaratan::create([
                        'pengajuan_id'   => $pengajuan->id,
                        'nik'            => $data['nik'],
                        'pelayanan_id'   => $data['pelayanan_id'],
                        'persyaratan_id' => $persyaratanId,
                        'dokumen'        => $path,
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Berhasil mengajukan permohonan.');

        } catch (\Exception $e) {
            // Baris ini berguna untuk debugging jika terjadi error
            Log::error('Error saat pengajuan: ' . $e->getMessage()); 
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }


}


