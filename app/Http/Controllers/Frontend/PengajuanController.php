<?php
// File: app/Http/Controllers/Frontend/PengajuanController.php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\DokumenPersyaratan;
use App\Models\Masyarakat;
use App\Models\Pelayanan;
use App\Models\Pengajuan;
use App\Services\FcmService; // ✅ TAMBAHKAN INI
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PengajuanController extends Controller
{
    protected $fcmService; // ✅ TAMBAHKAN INI

    // ✅ TAMBAHKAN CONSTRUCTOR
    public function __construct(FcmService $fcmService)
    {
        $this->fcmService = $fcmService;
    }

    public function index($id)
    {
        $title = "Form Cek NIK";
        return view('frontend.pengajuan.index', compact('title', 'id'));
    }

    public function cek(Request $request, $id)
    {
        $nik = Masyarakat::where('nik', $request->nik)->value('nik');
        if (!$nik) {
            return back()->with('error', 'NIK tidak ditemukan, Silahkan daftar ke kelurahan tipulu');
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
        // Validasi
        $data = $request->validate([
            'pelayanan_id' => 'required',
            'nik' => 'required|exists:masyarakats,nik',
            'no_hp' => 'required|string|digits_between:10,15',
            'dokumen' => 'required|array',
            'dokumen.*' => 'file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        try {
            // Cari data masyarakat dan pelayanan
            $masyarakat = Masyarakat::where('nik', $data['nik'])->first();
            $pelayanan = Pelayanan::find($data['pelayanan_id']);

            // Buat pengajuan
            $pengajuan = Pengajuan::create([
                'nik' => $data['nik'],
                'pelayanan_id' => $data['pelayanan_id'],
                'no_hp' => $data['no_hp']
            ]);

            // Upload dokumen
            foreach ($data['dokumen'] as $persyaratanId => $file) {
                if ($request->hasFile("dokumen.$persyaratanId")) {
                    $file = $request->file("dokumen.$persyaratanId");
                    $filename = $data['nik'] . '-' . $persyaratanId . '-' . time() . '.' . $file->getClientOriginalExtension();
                    $file->storeAs('public/dokumen', $filename);
                    $path = 'storage/dokumen/' . $filename;

                    DokumenPersyaratan::create([
                        'pengajuan_id' => $pengajuan->id,
                        'nik' => $data['nik'],
                        'pelayanan_id' => $data['pelayanan_id'],
                        'persyaratan_id' => $persyaratanId,
                        'dokumen' => $path,
                    ]);
                }
            }

            // ✅ KIRIM NOTIFIKASI KE SEMUA ADMIN
            $this->fcmService->sendToAllAdmins(
                '📝 Pengajuan Baru!',
                "Pengajuan {$pelayanan->nama} dari {$masyarakat->nama}",
                [
                    'type' => 'new_pengajuan',
                    'pengajuan_id' => (string) $pengajuan->id,
                    'pelayanan_id' => (string) $pelayanan->id,
                    'pelayanan_nama' => $pelayanan->nama,
                    'pengaju_nama' => $masyarakat->nama,
                    'pengaju_nik' => $masyarakat->nik,
                ]
            );

            Log::info('Pengajuan berhasil dibuat', [
                'pengajuan_id' => $pengajuan->id,
                'nik' => $masyarakat->nik,
                'pelayanan' => $pelayanan->nama
            ]);

            return redirect()->back()->with('success', 'Berhasil mengajukan permohonan.');

        } catch (\Exception $e) {
            Log::error('Error saat pengajuan: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }
}