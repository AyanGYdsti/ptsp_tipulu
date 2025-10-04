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
        $data = $request->validate([
            'nama_instansi'     => 'required|string|max:255',
            'slogan'            => 'required|string',
            'deskripsi'         => 'required|string',
            'visi'              => 'required|string',
            'misi'              => 'required|string',
            'koordinat'         => 'required|string',
            'alamat'            => 'required|string',
            'telpon'            => 'required|string|max:50',
            'waktu_pelayanan'   => 'required|string',
        ]);
        
        try {
            // updateOrCreate -> kalau ada id, update. Kalau tidak, create.
            LandingPage::updateOrCreate(
                ['id' => $request->id],
                $data
            );

            return back()->with('success', 'Berhasil menyimpan data.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menyimpan data.');
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
    return view('frontend.sejarah.detail', compact('landingPage'));
}

public function detailVisiMisi()
{
    $landingPage = LandingPage::first(); 
    return view('frontend.visimisi.index', compact('landingPage'));
}

}
