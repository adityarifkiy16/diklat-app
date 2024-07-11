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
                ->toJson();
        }

        return view('peserta.index');
    }

    public function deletePeserta($id)
    {
        $peserta = MPeserta::findorFail($id);
        $peserta->delete();

        return response()->json(['code' => 200, 'data' => ['message' => 'berhasil menghapus data']]);
    }
}
