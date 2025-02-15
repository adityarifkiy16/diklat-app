<?php

namespace App\Http\Controllers;

use App\Models\MDiklat;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DiklatController extends Controller
{
    function index(Request $request)
    {
        if ($request->ajax()) {
            $diklat = MDiklat::query();
            return DataTables::eloquent($diklat)
                ->addIndexColumn()
                ->only(['id', 'name', 'room'])
                ->toJson();
        }

        return view('master.diklat.index');
    }

    public function create()
    {
        return view('master.diklat.tambah');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'diklat' => 'required|string|max:255|unique:MDiklat,name',
            'room' => 'required|string|max:255|unique:MDiklat,room',
        ]);

        MDiklat::create([
            'name' => $data['diklat'],
            'room' => $data['room'],
        ]);

        return response()->json(
            [
                'code' => 200,
                'data' => [
                    'message' => 'berhasil menambah diklat'
                ]
            ]
        );
    }

    public function deletediklat($id)
    {
        $diklat = MDiklat::findorFail($id);
        if ($diklat->peserta()->exists()) {
            return response()->json([
                'code' => 400,
                'data' => [
                    'message' => 'Gagal menghapus data user karena relasi dengan data peserta'
                ]
            ]);
        }

        $diklat->delete();
        return response()->json(['code' => 200, 'data' => ['message' => 'berhasil menghapus data']]);
    }
}
