<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MInstructor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class InstrukturController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $instruktur = MInstructor::with('penjadwalan');
            return DataTables::eloquent($instruktur)
                ->addIndexColumn()
                ->toJson();
        }

        return view('master.instruktur.index');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255',  Rule::unique('users', 'username')->whereNull('deleted_at')],
            'email' => ['required', 'email', Rule::unique('users', 'email')->whereNull('deleted_at')],
            'password' => 'required|string|confirmed|min:8',
        ]);

        $data['password'] =  Hash::make($data['password']);
        User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role_id' => 3
        ]);
        MInstructor::create([
            'name' => $data['name']
        ]);
        return response()->json(['code' => 200, 'message' => 'Instruktur berhasil ditambahkan.']);
    }

    public function delete($id)
    {
        $instruktur = MInstructor::findorFail($id);
        if ($instruktur->penjadwalan()->exist()) {
            return response()->json([
                'code' => 400,
                'data' => [
                    'message' => 'Gagal menghapus data instruktur karena relasi dengan data penjadwalan'
                ]
            ]);
        }
        $instruktur->delete();
        return response()->json(['code' => 200, 'data' => ['message' => 'berhasil menghapus data']]);
    }
}
