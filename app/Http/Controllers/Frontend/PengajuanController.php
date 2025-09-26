<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\DokumenPersyaratan;
use App\Models\Masyarakat;
use App\Models\Pelayanan;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        $data = $request->validate([
            'pelayanan_id' => 'required',
            'nik'          => 'required',
            'dokumen'      => 'required|array',
            'dokumen.*'    => 'file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        try {
            $pengajuan = Pengajuan::create([
                'nik' => $data['nik'],
                'pelayanan_id' => $data['pelayanan_id'],
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

            return redirect()->route('pengajuan.detail', ['id' => $data['pelayanan_id'], 'nik' => $data['nik']])->with('success', 'Berhasil menambah data.');
        } catch (\Exception $e) {
            return redirect()->route('pengajuan.detail', ['id' => $data['pelayanan_id'], 'nik' => $data['nik']])->with('error', 'Terjadi kesalahan saat menyimpan dokumen.');
        }
    }
}
