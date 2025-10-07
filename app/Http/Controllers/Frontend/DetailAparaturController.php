<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Aparatur;
use Illuminate\Http\Request;

class DetailAparaturController extends Controller
{
    /**
     * Display a listing of aparatur (Frontend Public).
     */
    public function index()
    {
        // Mengambil semua data aparatur, diurutkan berdasarkan posisi
        $aparatur = Aparatur::orderBy('posisi', 'asc')->get();

        return view('frontend.aparatur.detail', compact('aparatur'));
    }
}
