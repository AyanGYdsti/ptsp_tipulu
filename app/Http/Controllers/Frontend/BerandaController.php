<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\LandingPage;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        $title = 'Beranda';

        $landingPage = LandingPage::first();

        return view('frontend.beranda.index', compact('title', 'landingPage'));
    }
}
