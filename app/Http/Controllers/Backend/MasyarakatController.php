<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Masyarakat;
use Illuminate\Http\Request;

class MasyarakatController extends Controller
{
    public function index(Request $request)
{
    $title = "Masyarakat";

    $query = Masyarakat::query();

    if ($request->filled('q')) {
        $query->where('nama', 'like', '%' . $request->q . '%')
              ->orWhere('nik', 'like', '%' . $request->q . '%')
              ->orWhere('alamat', 'like', '%' . $request->q . '%');
    }

        $masyarakat = $query->orderBy('nama', 'asc')->paginate(10);

        // Simpan parameter pencarian agar tetap ada saat berpindah halaman
        $masyarakat->appends(['q' => $request->q]);

        return view('backend.masyarakat.index', compact('title', 'masyarakat'))
               ->with('q', $request->q);

}


    public function edit($id)
    {
        $title = "Edit Masyarakat";
        $masyarakat = Masyarakat::where('nik', $id)->first();

        return view('backend.masyarakat.edit', compact('title', 'masyarakat'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nik' => 'required|unique:masyarakats,nik',
            'nama' => 'required',
            'RT' => 'required',
            'RW' => 'required',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'status' => 'required',
            'pekerjaan' => 'required',
            'agama' => 'required',
            'jk' => 'required',
            'no_hp' => 'nullable'

        ], [
            'nik.unique' => 'NIK sudah terdaftar.',
        ]);

        try {
            Masyarakat::create($data);

            return back()->with('success', 'Berhasil menambah data');
        } catch (\Exception $e) {
            return "gagal";
            back()->with('error', 'Gagal menambah data');
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nik' => 'required|unique:masyarakats,nik,' . $id . ',nik',
            'nama' => 'required',
            'RT'=> 'required',
            'RW'=> 'required',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'status' => 'required',
            'pekerjaan' => 'required',
            'agama' => 'required',
            'jk' => 'required',
            'no_hp' => 'nullable',
        ], [
            'nik.unique' => 'NIK sudah terdaftar.',
        ]);

        $masyarakat = Masyarakat::where('nik', $id);

        try {
            $masyarakat->update($data);

            return redirect('/masyarakat')->with('success', 'Berhasil update data');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal update data');
        }
    }

    public function delete($id)
    {
        $masyarakat = Masyarakat::where('nik', $id);

        try {
            $masyarakat->delete();

            return back()->with('success', 'Berhasil menghapus data');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus data');
        }
    }
}
