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
use Illuminate\Support\Facades\Storage;

Carbon::setLocale('id');

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
            $alasan = $request->input('alasan'); // Ambil alasan dari request

            Verifikasi::create([
                'pengajuan_id' => $id,
                'status' => $status . ' oleh ' . Auth::user()->username,
                'alasan' => $alasan, // Simpan alasan
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
                'domisiliUsahaYayasans', 'usaha', 'tempatTinggalSementara'
            ])->findOrFail($id);

            $aparatur = Aparatur::findOrFail($request->aparatur_id);

            // Siapkan semua data yang akan dikirim ke view PDF
            $dataForView = [
                'judul' => $pengajuan->pelayanan->nama,
                'tahun' => Carbon::parse($request->tgl_cetak)->format('Y'),
                'tanggal' => Carbon::parse($request->tgl_cetak)->isoFormat('D MMMM Y'),
                'nama_pengaju' => ucwords(strtolower(optional($pengajuan->masyarakat)->nama ?? optional($pengajuan->tempatTinggalSementara)->nama)),
                'tempat_lahir' => ucwords(strtolower(optional($pengajuan->masyarakat)->tempat_lahir ?? optional($pengajuan->tempatTinggalSementara)->tempat_lahir)),
                'tanggal_lahir' => optional($pengajuan->masyarakat)->tgl_lahir
                    ? Carbon::parse($pengajuan->masyarakat->tgl_lahir)->isoFormat('D MMMM Y')
                    : (optional($pengajuan->tempatTinggalSementara)->tgl_lahir
                        ? Carbon::parse($pengajuan->tempatTinggalSementara->tgl_lahir)->isoFormat('D MMMM Y')
                        : null),
                'jenis_kelamin' => ucwords(strtolower(optional($pengajuan->masyarakat)->jk ?? optional($pengajuan->tempatTinggalSementara)->jenis_kelamin)),
                'agama' => ucwords(strtolower(optional($pengajuan->masyarakat)->agama ?? optional($pengajuan->tempatTinggalSementara)->agama)),
                'pekerjaan' => ucwords(strtolower(optional($pengajuan->masyarakat)->pekerjaan ?? optional($pengajuan->tempatTinggalSementara)->pekerjaan)),
                'alamat' => ucwords(strtolower(optional($pengajuan->masyarakat)->alamat ?? optional($pengajuan->tempatTinggalSementara)->alamat)),
                'nik' => optional($pengajuan->masyarakat)->nik ?? optional($pengajuan->tempatTinggalSementara)->nik,
                'status' => ucwords(strtolower($pengajuan->masyarakat->status ?? $pengajuan->tempatTinggalSementara->status ?? '....')),
                'keterangan_surat' => str_replace(
                    [
                        '{{ $tahun_berdiri }}',
                        '{{ $keperluan }}',
                        '{{ $alamat_sementara }}',
                        '{{ $rt }}',
                        '{{ $rw }}',
                        '{{ $deskripsi_acara }}',
                        '{{ $nama_acara }}',
                    ],
                    [
                        optional($pengajuan->usaha)->tahun_berdiri ?? '....',
                        '<b>' . ucwords(strtolower($pengajuan->keperluan ?? '....')) . '</b>',
                        ucwords(strtolower(optional($pengajuan->tempatTinggalSementara)->alamat_sementara ?? '....')),
                        str_pad($pengajuan->tempatTinggalSementara->RT ?? 0, 3, '0', STR_PAD_LEFT),
                        str_pad($pengajuan->tempatTinggalSementara->RW ?? 0, 3, '0', STR_PAD_LEFT),
                        '<b>' . strtoupper(optional($pengajuan->keramaian)->deskripsi_acara ?? '....') . '</b>',
                        '<b>' . strtoupper(optional($pengajuan->keramaian)->nama_acara ?? '....') . '</b>',
                    ],
                    $pengajuan->pelayanan->keterangan_surat
                ),
                'rt' => str_pad($pengajuan->masyarakat->RT ?? 0, 3, '0', STR_PAD_LEFT),
                'rw' => str_pad($pengajuan->masyarakat->RW ?? 0, 3, '0', STR_PAD_LEFT),
                'jabatan' => ucwords(strtolower($aparatur->jabatan)),
                'aparatur' => ucwords(strtolower($aparatur->nama)),
                'aparatur_nip' => $aparatur->nip,
                'nama_md' => ucwords(strtolower(optional($pengajuan->kematian)->nama)),
                'jenis_kelamin_md'=> ucwords(strtolower(optional($pengajuan->kematian)->jenis_kelamin)),
                'umur' => optional($pengajuan->kematian)->umur,
                'alamat_md' => ucwords(strtolower(optional($pengajuan->kematian)->alamat)),
                'tanggal_meninggal' => optional($pengajuan->kematian)->tanggal_meninggal
                    ? Carbon::parse($pengajuan->kematian->tanggal_meninggal)->isoFormat('D MMMM Y')
                    : null,
                'hari_meninggal' => ucwords(strtolower(optional($pengajuan->kematian)->hari)),
                'tempat_meninggal'=> ucwords(strtolower(optional($pengajuan->kematian)->tempat_meninggal)),
                'penyebab_md' => ucwords(strtolower(optional($pengajuan->kematian)->penyebab)),
                'desa_kelurahan' => ucwords(strtolower(optional($pengajuan->pindahPenduduk)->desa_kelurahan)),
                'kecamatan' => ucwords(strtolower(optional($pengajuan->pindahPenduduk)->kecamatan)),
                'kab_kota' => ucwords(strtolower(optional($pengajuan->pindahPenduduk)->kab_kota)),
                'provinsi' => ucwords(strtolower(optional($pengajuan->pindahPenduduk)->provinsi)),
                'tgl_pindah' => optional($pengajuan->pindahPenduduk)->tanggal_pindah
                                ? Carbon::parse($pengajuan->pindahPenduduk->tanggal_pindah)->isoFormat('D MMMM Y')
                                : null,
                'alasan_pindah' => ucwords(strtolower(optional($pengajuan->pindahPenduduk)->alasan_pindah)),
                'pengikut' => optional($pengajuan->pindahPenduduk)->pengikut,
                'nama_usaha' => ucwords(strtolower(optional($pengajuan->domisiliUsahaYayasan)->nama_usaha)),
                'jenis_kegiatan_usaha' => ucwords(strtolower(optional($pengajuan->domisiliUsahaYayasan)->jenis_kegiatan_usaha)),
                'alamat_usaha' => ucwords(strtolower(optional($pengajuan->domisiliUsahaYayasan)->alamat_usaha)),
                'penanggung_jawab' => ucwords(strtolower(optional($pengajuan->domisiliUsahaYayasan)->penanggung_jawab)),
                'tahun_berdiri' => optional($pengajuan->usaha)->tahun_berdiri,
                'nama_usaha_pengaju' => ucwords(strtolower(optional($pengajuan->usaha)->nama_usaha)),
                'nama_acara' => strtoupper(optional($pengajuan->keramaian)->nama_acara),
                'waktu_acara' => optional($pengajuan->keramaian)->pukul,
                'tempat_acara' => ucwords(strtolower(optional($pengajuan->keramaian)->tempat)),
                'tanggal_acara' => optional($pengajuan->keramaian)->tanggal
                                    ? Carbon::parse($pengajuan->keramaian->tanggal)->isoFormat('D MMMM Y')
                                    : null,
                'penyelenggara_acara' => ucwords(strtolower(optional($pengajuan->keramaian)->penyelenggara)),
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

    /**
     * Method untuk menghapus data pengajuan
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            Log::info("Memulai proses hapus pengajuan", ['id' => $id]);

            // Cari data pengajuan dengan relasi dokumen
            $pengajuan = Pengajuan::with('dokumenPersyaratan')->findOrFail($id);

            // Hapus file dokumen persyaratan jika ada
            if ($pengajuan->dokumenPersyaratan->count() > 0) {
                foreach ($pengajuan->dokumenPersyaratan as $dokumen) {
                    $filePath = public_path($dokumen->dokumen);

                    // Hapus file fisik jika ada
                    if (file_exists($filePath)) {
                        unlink($filePath);
                        Log::info("File dokumen dihapus", ['path' => $filePath]);
                    }
                }
            }

            // Hapus data verifikasi terkait
            Verifikasi::where('pengajuan_id', $id)->delete();

            // Hapus data dokumen persyaratan dari database
            DokumenPersyaratan::where('pengajuan_id', $id)->delete();

            // Hapus data pengajuan
            $pengajuan->delete();

            Log::info("Pengajuan berhasil dihapus", ['id' => $id]);

            return redirect()->back()->with('success', 'Data pengajuan berhasil dihapus');

        } catch (\Exception $e) {
            Log::error('Gagal menghapus pengajuan', [
                'id' => $id,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
