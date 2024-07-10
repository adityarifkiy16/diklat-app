<?php

namespace App\Http\Controllers;

use App\Models\MPeserta;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    public function index()
    {
        $peserta = MPeserta::with('user')->get();
        dd($peserta);
        return view('peserta.index', $peserta);
    }
}
