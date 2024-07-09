<?php

namespace App\Http\Controllers;

use App\Models\MPeserta;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    public function index()
    {
        $arr['peserta'] = MPeserta::with('user')->get();
        return view('peserta.index', $arr['peserta']);
    }
}
