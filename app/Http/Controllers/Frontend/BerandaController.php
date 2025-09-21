<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\LandingPage;
use App\Models\Pelayanan;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        $title = 'Beranda';

        $landingPage = LandingPage::first();

        $berita = Berita::get();

        $pelayanan = Pelayanan::paginate(3);

        return view('frontend.beranda.index', compact('title', 'landingPage', 'berita', 'pelayanan'));
    }
}
