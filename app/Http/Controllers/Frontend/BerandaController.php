<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Aparatur;
use App\Models\Berita;
use App\Models\LandingPage;
use App\Models\Pelayanan;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        $title = 'Beranda';

        $berita = Berita::get();

        $pelayanan = Pelayanan::paginate(3);

        $aparatur = Aparatur::orderBy('posisi', 'asc')->paginate(4);

        return view('frontend.beranda.index', compact('title', 'berita', 'pelayanan', 'aparatur'));
    }
}
