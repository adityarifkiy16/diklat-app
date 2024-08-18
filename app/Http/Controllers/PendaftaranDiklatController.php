<?php

namespace App\Http\Controllers;

use App\Models\MPeserta;
use App\Models\TDiklatpeserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendaftaranDiklatController extends Controller
{
    public function index()
    {
        $peserta = MPeserta::where('user_id', Auth::id())->first();
        if ($peserta) {
            $diklats = $peserta->diklat;
            return view('pendaftaran.index', ['dikpes' => $diklats]);
        }
    }
    public function create()
    {
        return view('pendaftaran.create');
    }
}
