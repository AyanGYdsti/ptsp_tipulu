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
use App\Models\Kematian;
use App\Models\Usaha;
use App\Models\Keramaian;
use App\Models\DomisiliUsahaYayasan;
use App\Models\PindahPenduduk;
use App\Models\TempatTinggalSementara;
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
        $pelayanan = Pelayanan::find($id);
        $title = "Form Cek NIK";

        // Kalau layanan = Tempat Tinggal Sementara → langsung ke detail
        if ($pelayanan && $pelayanan->nama === "Surat Keterangan Tempat Tinggal Sementara") {
            return redirect()->route('pengajuan.detail', [
                'id' => $id,
                'nik' => null // nanti di form detail diisi manual
            ]);
        }

        // Kalau layanan lain → tetap ke form cek NIK
        return view('frontend.pengajuan.index', compact('title', 'id'));
    }

    public function cek(Request $request, $id)
    {
        $pelayanan = Pelayanan::findOrFail($id);
        $masyarakat = Masyarakat::where('nik', $request->nik)->first();
        $nik = Masyarakat::where('nik', $request->nik)->value('nik');
        if (!$nik) {
            return back()->with('error', 'NIK tidak ditemukan, Silahkan daftar ke kelurahan tipulu');
        }

        if ($pelayanan->nama === "Surat Keterangan Belum Nikah") {
            if ($masyarakat->status !== "Belum Kawin" && $masyarakat->status !== "Belum Menikah") {
                return back()->with('error', 'Anda sudah menikah, tidak bisa mengajukan surat ini.');
            }
        }

        session()->forget(['error', 'success']);

        return redirect()->route('pengajuan.detail', ['id' => $id, 'nik' => $nik]);
    }

    public function detail($id, $nik = null)
    {
        $pelayanan = Pelayanan::findOrFail($id);

        if ($nik) {
            $masyarakat = Masyarakat::where('nik', $nik)->first();

            if (!$masyarakat) {
                return redirect()->back()->with('error', 'Data penduduk tidak ditemukan.');
            }
        } else {
            $masyarakat = null;
        }

        return view('frontend.pengajuan.detail', compact('pelayanan', 'masyarakat'));
    }


    public function store(Request $request)
    {
        // Validasi dasar
        // Ambil dulu pelayanan
        $pelayanan = Pelayanan::find($request->pelayanan_id);

        // Validasi dasar
        $rules = [
            'pelayanan_id' => 'required',
            'no_hp' => 'required|string|digits_between:10,15',
            'keperluan' => 'nullable|string',
            'dokumen' => 'required|array',
            'dokumen.*' => 'file|mimes:pdf,jpg,jpeg,png|max:2048',
        ];

        // Jika pelayanan = Surat Keterangan Tempat Tinggal Sementara
        if ($pelayanan && $pelayanan->nama === "Surat Keterangan Tempat Tinggal Sementara") {
            $rules['nik'] = 'required|digits:16';
            $rules = array_merge($rules, [
                'nik'              => 'required|string',
                'nama'             => 'required|string',
                'alamat_sementara' => 'required|string',
                'jenis_kelamin'    => 'required|string',
                'RT'               => 'required|integer',
                'RW'               => 'required|integer',
                'tgl_lahir'        => 'required|date',
                'tempat_lahir'     => 'required|string',
                'agama'            => 'required|string',
                'status'           => 'required|string',
                'pekerjaan'        => 'required|string',
            ]);
        } else {
            // Layanan biasa -> nik harus ada di tabel masyarakat
            $rules['nik'] = 'required|exists:masyarakats,nik';
            $masyarakat = Masyarakat::where('nik', $rules['nik'])->first();
        }

        $data = $request->validate($rules);

        try {
            $pengajuan = Pengajuan::create([
                'nik' => $data['nik'],
                'pelayanan_id' => $data['pelayanan_id'],
                'no_hp' => $data['no_hp'],
                'keperluan' => $data['keperluan'] ?? null,
            ]);

            // ✅ SIMPAN DATA KE TABEL KEMATIANS JIKA PELAYANAN SURAT KEMATIAN
            if ($pelayanan && $pelayanan->nama === "Surat Keterangan Kematian") {
                $request->validate([
                    'nama'           => 'required|string',
                    'jenis_kelamin'  => 'required|string',
                    'umur'           => 'required|integer',
                    'alamat'         => 'required|string',
                    'hari'           => 'required|string',
                    'tanggal_meninggal'        => 'required|date',
                    'tempat_meninggal' => 'required|string',
                    'penyebab'       => 'required|string',
                ]);

                Kematian::create([
                    'pengajuan_id'   => $pengajuan->id,
                    'nama'           => $request->nama,
                    'jenis_kelamin'  => $request->jenis_kelamin,
                    'umur'           => $request->umur,
                    'alamat'         => $request->alamat,
                    'hari'           => $request->hari,
                    'tanggal_meninggal'        => $request->tanggal_meninggal,
                    'tempat_meninggal' => $request->tempat_meninggal,
                    'penyebab'       => $request->penyebab,
                ]);
            }

            // ✅ SIMPAN DATA KE TABEL PINDAH_PENDUDUK JIKA PELAYANAN SURAT PINDAH
            elseif ($pelayanan && $pelayanan->nama === "Surat Keterangan Pindah Penduduk") {
                $request->validate([
                    'desa_kelurahan' => 'required|string',
                    'kecamatan'      => 'required|string',
                    'kab_kota'      => 'required|string',
                    'provinsi'       => 'required|string',
                    'tanggal_pindah' => 'required|date',
                    'alasan_pindah'  => 'nullable|string',
                    'pengikut'       => 'nullable|integer', // kalau jumlah orang
                ]);

                PindahPenduduk::create([
                    'pengajuan_id'   => $pengajuan->id,
                    'desa_kelurahan' => $request->desa_kelurahan,
                    'kecamatan'      => $request->kecamatan,
                    'kab_kota'       => $request->kab_kota,
                    'provinsi'       => $request->provinsi,
                    'tanggal_pindah' => $request->tanggal_pindah,
                    'alasan_pindah'  => $request->alasan_pindah,
                    'pengikut'       => $request->pengikut,
                ]);
            } elseif ($pelayanan && $pelayanan->nama === "Surat Keterangan Domisili Usaha dan Yayasan") {
                $request->validate([
                    'nama_usaha' => 'required|string',
                    'alamat_usaha' => 'required|string',
                    'jenis_kegiatan_usaha' => 'required|string',
                    'penanggung_jawab' => 'required|string',
                ]);

                // Simpan nama usaha di tabel pengajuans
                domisiliUsahaYayasan::create([
                    'pengajuan_id' => $pengajuan->id,
                    'nama_usaha' => $request->nama_usaha,
                    'jenis_kegiatan_usaha' => $request->jenis_kegiatan_usaha,
                    'alamat_usaha' => $request->alamat_usaha,
                    'penanggung_jawab' => $request->penanggung_jawab,
                ]);
            } elseif ($pelayanan && $pelayanan->nama === "Surat Keterangan Memiliki Usaha (SKU)") {
                $request->validate([
                    'nama_usaha' => 'required|string',
                    'tahun_berdiri' => 'required|date_format:Y',
                ]);

                // Simpan nama usaha di tabel pengajuans
                Usaha::create([
                    'pengajuan_id' => $pengajuan->id,
                    'nama_usaha' => $request->nama_usaha,
                    'tahun_berdiri' => $request->tahun_berdiri,
                ]);
            } elseif ($pelayanan && $pelayanan->nama === "Surat Izin Keramaian") {
                $request->validate([
                    'nama_acara'      => 'required|string',
                    'penyelenggara'   => 'nullable|string',
                    'deskripsi_acara' => 'nullable|string',
                    'tanggal'         => 'required|date',
                    'tempat'          => 'required|string',
                    'pukul'           => 'nullable|string',
                ]);

                Keramaian::create([
                    'pengajuan_id'   => $pengajuan->id,
                    'nama_acara'     => $request->nama_acara,
                    'penyelenggara'  => $request->penyelenggara,
                    'deskripsi_acara' => $request->deskripsi_acara,
                    'tanggal'        => $request->tanggal,
                    'tempat'         => $request->tempat,
                    'pukul'          => $request->pukul,
                ]);
            } elseif ($pelayanan && $pelayanan->nama === "Surat Keterangan Tempat Tinggal Sementara") {
                $request->validate([
                    'nama'             => 'required|string',
                    'nik'              => 'required|string',
                    'alamat_sementara' => 'required|string',
                    'jenis_kelamin'    => 'required|string',
                    'RT'               => 'required|integer',
                    'RW'               => 'required|integer',
                    'tgl_lahir'        => 'required|date',
                    'tempat_lahir'     => 'required|string',
                    'agama'            => 'required|string',
                    'status'           => 'required|string',
                    'pekerjaan'        => 'required|string',
                ]);

                TempatTinggalSementara::create([
                    'pengajuan_id'     => $pengajuan->id,
                    'nama'             => $request->nama,
                    'nik'              => $request->nik,
                    'alamat_sementara' => $request->alamat_sementara,
                    'jenis_kelamin'    => $request->jenis_kelamin,
                    'RT'               => $request->RT,
                    'RW'               => $request->RW,
                    'tgl_lahir'        => $request->tgl_lahir,
                    'tempat_lahir'     => $request->tempat_lahir,
                    'agama'            => $request->agama,
                    'status'           => $request->status,
                    'pekerjaan'        => $request->pekerjaan,
                ]);
            }



            // Upload dokumen persyaratan
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

            // ✅ KIRIM NOTIFIKASI KE ADMIN
            $pengajuNama = '';
            if ($pelayanan && $pelayanan->nama === "Surat Keterangan Tempat Tinggal Sementara") {
                // Untuk layanan ini, nama diambil langsung dari input form yang sudah divalidasi
                $pengajuNama = $data['nama'];
            } else {
                // Untuk layanan lain, ambil dari relasi 'masyarakat' yang ada di model Pengajuan.
                // Ini lebih andal karena model $pengajuan sudah pasti ada.
                $pengajuNama = optional($pengajuan->masyarakat)->nama;
            }

            // Sediakan nilai fallback (pengganti) jika nama tetap kosong karena alasan apapun
            $namaUntukNotif = $pengajuNama ?? 'Pengaju Tidak Dikenal';
            $pelayananNama = optional($pelayanan)->nama ?? 'Layanan';

            // ✅ KIRIM NOTIFIKASI KE ADMIN DENGAN DATA YANG SUDAH AMAN
            $this->fcmService->sendToAllAdmins(
                '📝 Pengajuan Baru!',
                "Pengajuan {$pelayananNama} dari {$namaUntukNotif}",
                [
                    'type' => 'new_pengajuan',
                    'pengajuan_id' => (string) $pengajuan->id,
                    'pelayanan_id' => (string) $pengajuan->pelayanan_id,
                    'pelayanan_nama' => $pelayananNama,
                    'pengaju_nama' => $namaUntukNotif,
                    'pengaju_nik' => $pengajuan->nik,
                ]
            );

            Log::info('Pengajuan berhasil dibuat', [
                'pengajuan_id' => $pengajuan->id,
                'nik' => $pengajuan->nik,
                'pelayanan' => $pelayananNama
            ]);

            return redirect()->back()->with('success', 'Berhasil mengajukan permohonan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
