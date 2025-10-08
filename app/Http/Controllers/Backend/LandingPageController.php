<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\LandingPage;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $title = "Manajemen Landing Page";

        $landingPage = LandingPage::first();

        return view('backend.landing-page.index', compact('title', 'landingPage'));
    }

public function store(Request $request)
{
    try {
        // 🔹 1. Ambil data landing page pertama (karena biasanya hanya 1 data)
        $landingPage = LandingPage::first();

        // 🔹 2. Validasi dinamis (bisa full update atau partial)
        $rules = [
            'nama_instansi'   => 'sometimes|string|max:255',
            'slogan'          => 'sometimes|string|max:255',
            'deskripsi'       => 'sometimes|string',
            'visi'            => 'sometimes|string',
            'misi'            => 'sometimes|string',
            'koordinat'       => 'sometimes|string|max:100',
            'alamat'          => 'sometimes|string|max:255',
            'telpon'          => 'sometimes|string|max:50',
            'email'           => 'sometimes|email|max:255',
            'waktu_pelayanan' => 'sometimes|string|max:255',
        ];

        $data = $request->validate($rules);

        // 🔹 3. Jika data belum ada → buat baru, kalau ada → update
        if (!$landingPage) {
            LandingPage::create($data);
            return back()->with('success', 'Data landing page berhasil dibuat.');
        } else {
            $landingPage->update($data);
            return back()->with('success', 'Data landing page berhasil diperbarui.');
        }
    } catch (\Exception $e) {
        // 🔹 4. Tangani error & tampilkan pesan
        return back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
    }
}

    public function sejarah()
{
    $landingPage = LandingPage::first(); 
    return view('frontend.sejarah.index', compact('landingPage'));
}

public function detailSejarah()
{
    $landingPage = LandingPage::first(); 
    return view('frontend.sejarah.index', compact('landingPage'));
}

public function detailVisiMisi()
{
    $landingPage = LandingPage::first(); 
    return view('frontend.visimisi.index', compact('landingPage'));
}

}
