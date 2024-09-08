<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MRole;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $roles = MRole::where('id', "!=", 1)->get();
        if ($request->ajax()) {
            $user = User::with('roles');
            return DataTables::eloquent($user)
                ->addIndexColumn()
                ->toJson();
        }
        return view('master.user.index', ["roles" => $roles]);
    }

    public function create()
    {
        $role = MRole::all();
        return view('master.user.tambah', ['roles' => $role]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // dd($request->validator->failed());

        $data = $request->validate([
            'username' => ['required', 'string', 'max:255',  Rule::unique('users', 'username')->whereNull('deleted_at')],
            'email' => ['required', 'email', Rule::unique('users', 'email')->whereNull('deleted_at')],
            'password' => 'required|string|confirmed|min:8',
            'role' => 'required|exists:MRole,id'
        ]);

        $data['password'] = Hash::make($data['password']);

        User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role_id' => $data['role'],
        ]);

        return response()->json(
            [
                'code' => 200,
                'data' => [
                    'message' => 'Berhasil menambah user ' . $data['username']
                ]
            ]
        );
    }

    public function deleteUser($id)
    {
        $user = User::findorFail($id);
        $isInstruktur = $user->instruktur()->exists();
        $isPeserta = $user->peserta()->exists();
        if ($isInstruktur) {
            $user->instruktur()->delete();
        }
        if ($isPeserta) {
            $user->peserta()->delete();
        }

        $user->delete();

        return response()->json(['code' => 200, 'data' => ['message' => $user->username . ' dan data terkait berhasil dihapus']]);
    }

    public function edit($id)
    {
        $user = User::findorFail($id);
        if ($user) {
            return response()->json([
                'code' => 200,
                'data' => $user
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::findorFail($id);
        $data = $request->validate([
            'username' => ['required', 'string', 'max:255',  Rule::unique('users', 'username')->whereNull('deleted_at')->ignore($user->id)],
            'email' => ['required', 'email', Rule::unique('users', 'email')->whereNull('deleted_at')->ignore($user->id)],
            'password' => 'nullable|confirmed|min:8',
            'role' => 'required|exists:MRole,id'
        ]);

        $data['password'] = Hash::make($data['password']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($data['password']);
            $user->password = $data['password'];
        }

        if (isset($data['role'])) {
            $user->role_id = $data['role'];
        }
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->save();

        return response()->json(['code' => 200, 'data' => ['message' => 'berhasil update data']]);
    }
}
