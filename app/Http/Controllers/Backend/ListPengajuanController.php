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
                'aparatur_id' => 4,
            ]);

            return back()->with('success', 'Berhasil ' . strtolower($status) . ' data');
        } catch (\Throwable $th) {
            Log::error('Gagal verifikasi data: ' . $th->getMessage());
            return back()->with('error', 'Gagal verifikasi data');
        }
    }

    // ✅ Method BARU untuk STREAM (tampilkan PDF di viewer)
    public function handleCetakStream(Request $request, $id)
    {
        return $this->generatePdf($request, $id, 'stream');
    }

    // ✅ Method BARU untuk DOWNLOAD (download PDF)
    public function handleCetakDownload(Request $request, $id)
    {
        return $this->generatePdf($request, $id, 'download');
    }

    // ✅ Method PRIVATE untuk generate PDF (digunakan oleh kedua method di atas)
    private function generatePdf(Request $request, $id, $action)
    {
        $pengajuan = Pengajuan::with(['pelayanan', 'dokumenPersyaratan.persyaratan'])->find($id);
        $pengajuan->load('kematian'); // Memuat relasi kematian
        $pengajuan->load('pindahPenduduk'); // Memuat relasi pindah penduduk
        $aparatur = Aparatur::where('id', $request->aparatur_id)->value('nama');
        $aparatur_nip = Aparatur::where('id',$request->aparatur_id)->value('nip');
        $aparatur_jabatan = Aparatur::where('id', $request->aparatur_id)->value('jabatan');
        // $aparatur_nip = Aparatur::where('id', $request->aparatur_id)->value('nip');
        $pdf = Pdf::loadView('backend.surat.template-surat', [
            'judul' => $pengajuan->pelayanan->nama,
            'tahun' => Carbon::parse($request->tgl_cetak)->format('Y'),
            'tanggal' => Carbon::parse($request->tgl_cetak)->format('d-m-Y'),
            'nama_pengaju' => $pengajuan->masyarakat->nama,
            'tempat_lahir' => $pengajuan->masyarakat->tempat_lahir,
            'tanggal_lahir' => Carbon::parse($pengajuan->masyarakat->tgl_lahir)->format('d-m-Y'),
            'jenis_kelamin' => $pengajuan->masyarakat->jk,
            'agama' => $pengajuan->masyarakat->agama,
            'pekerjaan' => $pengajuan->masyarakat->pekerjaan,
            'alamat' => $pengajuan->masyarakat->alamat,
            'nik' => $pengajuan->masyarakat->nik,
            'keterangan_surat' => str_replace(
                [
                    '{{ $tahun_berdiri }}',
                    '{{ $keperluan }}',
                    '{{ $alamat_sementara }}',
                    '{{ $rt }}',
                    '{{ $rw }}',
                ],
                [
                    $pengajuan->usaha->tahun_berdiri ?? '....',
                   '<b>' . ($pengajuan->keperluan ?? '....') . '</b>',
                    optional($pengajuan->tempat_tinggal_sementara)->alamat_sementara ?? '....',
                    $pengajuan->masyarakat->rt ?? '....',
                    $pengajuan->masyarakat->rw ?? '....',
                ],
                $pengajuan->pelayanan->keterangan_surat
            ),
            'jabatan' => $aparatur_jabatan,
            'status' => $pengajuan->status,
            'aparatur' => $aparatur,
            'aparatur_nip' => $aparatur_nip,
            'nama_md'         => optional($pengajuan->kematian)->nama,
            'jenis_kelamin_md'=> optional($pengajuan->kematian)->jenis_kelamin,
            'umur'            => optional($pengajuan->kematian)->umur,
            'alamat_md'       => optional($pengajuan->kematian)->alamat,
            'tanggal_meninggal' => optional($pengajuan->kematian)->tanggal_meninggal
                                    ? Carbon::parse($pengajuan->kematian->tanggal_meninggal)->format('d-m-Y')
                                    : null,
            'hari_meninggal'  => optional($pengajuan->kematian)->hari,
            'tempat_meninggal'=> optional($pengajuan->kematian)->tempat_meninggal,
            'penyebab_md'     => optional($pengajuan->kematian)->penyebab,
            'desa_kelurahan'  => optional($pengajuan->pindahPenduduk)->desa_kelurahan,
            'kecamatan'       => optional($pengajuan->pindahPenduduk)->kecamatan,
            'kab_kota'        => optional($pengajuan->pindahPenduduk)->kab_kota,
            'provinsi'        => optional($pengajuan->pindahPenduduk)->provinsi,
            'tgl_pindah' =>  optional($pengajuan->pindahPenduduk)->tanggal_pindah,
            'alasan_pindah' => optional($pengajuan->pindahPenduduk)->alasan_pindah,
            'pengikut' => optional($pengajuan->pindahPenduduk)->pengikut,
            'nama_usaha' => optional($pengajuan->domisiliUsahaYayasan)->nama_usaha,
            'jenis_kegiatan_usaha' => optional($pengajuan->domisiliUsahaYayasan)->jenis_kegiatan_usaha,
            'alamat_usaha' => optional($pengajuan->domisiliUsahaYayasan)->alamat_usaha,
            'penanggung_jawab' => optional($pengajuan->domisiliUsahaYayasan)->penanggung_jawab,
            'tahun_berdiri' => optional($pengajuan->usaha)->tahun_berdiri,
            'nama_usaha_pengaju' => optional($pengajuan->usaha)->nama_usaha,

            // Generate PDF
            $pdf = PDF::loadView('backend.surat.template-surat', $dataForView);
            
            Log::info("PDF generated successfully", ['action' => $action]);

            // Return berdasarkan action
            if ($action === 'download') {
                return $pdf->download('surat_' . $pengajuan->id . '.pdf');
            } else {
                return $pdf->stream('surat_' . $pengajuan->id . '.pdf');
            }

        } catch (\Exception $e) {
            Log::error('Error generating PDF', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal generate PDF: ' . $e->getMessage()
            ], 500);
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

        $filename = $persyaratan->nama . '.pdf';

        return response()->file($fullPath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename . '"',
        ]);
    }
}