<?php

namespace App\Http\Controllers;

use App\Models\MPeserta;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PesertaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $peserta = MPeserta::with('user');

            return DataTables::eloquent($peserta)
                ->addIndexColumn()
                ->removeColumn('id')
                ->toJson();
        }

        return view('peserta.index');
    }
}
