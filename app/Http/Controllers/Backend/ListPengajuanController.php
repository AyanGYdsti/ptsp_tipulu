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
use Illuminate\Support\Facades\Log;

class ListPengajuanController extends Controller
{
    public function index()
    {
        $title = "List Pengajuan";
        $pengajuan = Pengajuan::with(['pelayanan', 'masyarakat', 'dokumenPersyaratan.persyaratan'])->orderByDesc('id')->get();
        $aparaturs = Aparatur::get(['id', 'nama']);
        return view('backend.list-pengajuan.index', compact('title', 'pengajuan', 'aparaturs'));
    }

    public function verifikasi(Request $request, $id)
    {
        try {
            $status = $request->input('status', 'Ditolak');

            Verifikasi::create([
                'pengajuan_id' => $id,
                'status' => $status . ' oleh ' . Auth::user()->username,
                'aparatur_id' => 4, // Harap pastikan ID ini sesuai atau dinamis
            ]);

            return back()->with('success', 'Berhasil ' . strtolower($status) . ' data');
        } catch (\Throwable $th) {
            Log::error('Gagal verifikasi data: ' . $th->getMessage());
            return back()->with('error', 'Gagal verifikasi data');
        }
    }

    // Method publik untuk STREAM (tampilkan PDF di viewer)
    public function handleCetakStream(Request $request, $id)
    {
        return $this->generatePdf($request, $id, 'stream');
    }

    // Method publik untuk DOWNLOAD (unduh PDF)
    public function handleCetakDownload(Request $request, $id)
    {
        return $this->generatePdf($request, $id, 'download');
    }

    /**
     * Method private terpusat untuk men-generate PDF.
     * Menggabungkan semua logika persiapan data dan pembuatan PDF.
     */
    private function generatePdf(Request $request, $id, $action)
    {
        try {
            Log::info("Memulai proses generate PDF", [
                'id' => $id,
                'action' => $action,
                'request_data' => $request->all()
            ]);

            // Validasi input dari form
            $request->validate([
                'tgl_cetak' => 'required|date',
                'aparatur_id' => 'required|exists:aparaturs,id',
            ]);

            // Ambil semua data yang mungkin dibutuhkan dengan Eager Loading
            $pengajuan = Pengajuan::with([
                'pelayanan', 'masyarakat', 'kematian', 'pindahPenduduk',
                'domisiliUsahaYayasan', 'usaha', 'tempatTinggalSementara'
            ])->findOrFail($id);

            $aparatur = Aparatur::findOrFail($request->aparatur_id);

            // Siapkan semua data yang akan dikirim ke view PDF
            $dataForView = [
                'judul' => $pengajuan->pelayanan->nama,
                'tahun' => Carbon::parse($request->tgl_cetak)->format('Y'),
                'tanggal' => Carbon::parse($request->tgl_cetak)->isoFormat('D MMMM Y'),
                'nama_pengaju' => optional($pengajuan->masyarakat)->nama,
                'tempat_lahir' => optional($pengajuan->masyarakat)->tempat_lahir,
                'tanggal_lahir' => optional($pengajuan->masyarakat)->tgl_lahir ? Carbon::parse($pengajuan->masyarakat->tgl_lahir)->isoFormat('D MMMM Y') : null,
                'jenis_kelamin' => optional($pengajuan->masyarakat)->jk,
                'agama' => optional($pengajuan->masyarakat)->agama,
                'pekerjaan' => optional($pengajuan->masyarakat)->pekerjaan,
                'alamat' => optional($pengajuan->masyarakat)->alamat,
                'nik' => optional($pengajuan->masyarakat)->nik,
                'status' => $pengajuan->masyarakat->status,
                'keterangan_surat' => str_replace(
                    ['{{ $tahun_berdiri }}', '{{ $keperluan }}', '{{ $alamat_sementara }}', '{{ $rt }}', '{{ $rw }}'],
                    [
                        optional($pengajuan->usaha)->tahun_berdiri ?? '....',
                        '<b>' . ($pengajuan->keperluan ?? '....') . '</b>',
                        optional($pengajuan->tempat_tinggal_sementara)->alamat_sementara ?? '....',
                        optional($pengajuan->masyarakat)->rt ?? '..',
                        optional($pengajuan->masyarakat)->rw ?? '..',
                    ],
                    optional($pengajuan->pelayanan)->keterangan_surat ?? ''
                ),
                'jabatan' => $aparatur->jabatan,
                'aparatur' => $aparatur->nama,
                'aparatur_nip' => $aparatur->nip,
                'nama_md' => optional($pengajuan->kematian)->nama,
                'jenis_kelamin_md'=> optional($pengajuan->kematian)->jenis_kelamin,
                'umur' => optional($pengajuan->kematian)->umur,
                'alamat_md' => optional($pengajuan->kematian)->alamat,
                'tanggal_meninggal' => optional($pengajuan->kematian)->tanggal ? Carbon::parse($pengajuan->kematian->tanggal)->isoFormat('D MMMM Y') : null,
                'hari_meninggal' => optional($pengajuan->kematian)->hari,
                'tempat_meninggal'=> optional($pengajuan->kematian)->tempat_meninggal,
                'penyebab_md' => optional($pengajuan->kematian)->penyebab,
                'desa_kelurahan' => optional($pengajuan->pindahPenduduk)->desa_kelurahan,
                'kecamatan' => optional($pengajuan->pindahPenduduk)->kecamatan,
                'kab_kota' => optional($pengajuan->pindahPenduduk)->kab_kota,
                'provinsi' => optional($pengajuan->pindahPenduduk)->provinsi,
                'tgl_pindah' => optional($pengajuan->pindahPenduduk)->tanggal_pindah
                                ? Carbon::parse($pengajuan->pindahPenduduk->tanggal_pindah)->format('d-m-Y')
                                : null,

                'alasan_pindah' => optional($pengajuan->pindahPenduduk)->alasan_pindah,
                'pengikut' => optional($pengajuan->pindahPenduduk)->pengikut,
                'nama_usaha' => optional($pengajuan->domisiliUsahaYayasan)->nama_usaha,
                'jenis_kegiatan_usaha' => optional($pengajuan->domisiliUsahaYayasan)->jenis_kegiatan_usaha,
                'alamat_usaha' => optional($pengajuan->domisiliUsahaYayasan)->alamat_usaha,
                'penanggung_jawab' => optional($pengajuan->domisiliUsahaYayasan)->penanggung_jawab,
                'tahun_berdiri' => optional($pengajuan->usaha)->tahun_berdiri,
                'nama_usaha_pengaju' => optional($pengajuan->usaha)->nama_usaha,
            ];

            // Generate PDF dengan satu panggilan
            $pdf = PDF::loadView('backend.surat.template-surat', $dataForView);

            Log::info("PDF berhasil di-generate untuk action: {$action}");

            // Kembalikan respons berdasarkan action yang diminta
            if ($action === 'download') {
                return $pdf->download('surat_' . $pengajuan->id . '.pdf');
            } else { // 'stream'
                return $pdf->stream('surat_' . $pengajuan->id . '.pdf');
            }

        } catch (\Exception $e) {
            Log::error('Gagal saat generate PDF', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

           return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
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

        $filename = optional($persyaratan)->nama . '.pdf';

        return response()->file($fullPath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename . '"',
        ]);
    }
}

