<?php

namespace App\Http\Controllers;

use PDO;
use Carbon\Carbon;
use App\Models\User;
use App\Models\MPeserta;
use App\Models\MProvince;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class PesertaController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $peserta = MPeserta::with('tempatlahir');
            return DataTables::eloquent($peserta)
                ->addIndexColumn()
                ->editColumn('tanggal_lahir', function ($row) {
                    Carbon::setLocale('id');
                    return Carbon::parse($row->tanggal_lahir)->translatedFormat('d F Y');
                })
                ->toJson();
        }

        return view('peserta.index');
    }

    public function create()
    {
        return view('peserta.tambah');
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'nomer_telp' => 'required|string|max:16|regex:/^[^eE]*$/',
            'profesi' => 'required|string|max:255',
            'gender' => 'required|in:0,1',
            'kota' => 'required|exists:MRegencies,id',
            'tanggal_lahir' => 'required|date_format:m/d/Y',
            'alamat' => 'required|string',
            'username' => ['required', 'string', 'max:255',  Rule::unique('users', 'username')->whereNull('deleted_at')],
            'email' => ['required', 'email', Rule::unique('users', 'email')->whereNull('deleted_at')],
            'password' => 'required|string|min:8',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $tanggalLahir = Carbon::createFromFormat('m/d/Y', $validatedData['tanggal_lahir'])->format('Y-m-d');

        $user = User::create([
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
            'role_id' => 2
        ]);

        $validatedData['gender'] = $validatedData['gender'] === '1' ? 'male' : 'female';
        $validatedData['user_id'] = $user->id;
        MPeserta::create([
            'name' => $validatedData['name'],
            'tempat_lahir' => $validatedData['kota'],
            'tanggal_lahir' => $tanggalLahir,
            'alamat' => $validatedData['alamat'],
            'nama_ibu' => $validatedData['nama_ibu'],
            'nomer_telp' => $validatedData['nomer_telp'],
            'profesi' => $validatedData['profesi'],
            'gender' => $validatedData['gender'],
            'user_id' => $validatedData['user_id'],
        ]);

        return response()->json(['code' => 200, 'message' => 'Peserta berhasil ditambahkan.']);
    }

    public function deletePeserta($id)
    {
        $peserta = MPeserta::findorFail($id);
        $peserta->delete();

        return response()->json(['code' => 200, 'data' => ['message' => 'berhasil menghapus data']]);
    }
}
