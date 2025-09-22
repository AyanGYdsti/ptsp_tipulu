<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Masyarakat;
use Illuminate\Http\Request;

class MasyarakatController extends Controller
{
    public function index($id = '', $nik = '')
    {
        $title = "Form Data Penduduk";

        return view('frontend.masyarakat.index', compact('title', 'id', 'nik'));
    }

    public function store(Request $request, $id = '')
    {
        $data = $request->validate([
            'nik' => 'required|unique:masyarakats,nik',
            'nama' => 'required',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'status' => 'required',
            'pekerjaan' => 'required',
            'agama' => 'required',
            'jk' => 'required',
            'no_hp' => 'required',
        ], [
            'nik.unique' => 'NIK sudah terdaftar.',
        ]);

        try {
            Masyarakat::create($data);

            return $id ? redirect()->route('pengajuan.detail', ['id' => $id, 'nik' => $data['nik']]) : back()->with('success', 'Berhasil menambah data');
        } catch (\Exception $e) {
            back()->with('error', 'Gagal menambah data');
        }
    }
}
