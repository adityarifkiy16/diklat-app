<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $user = User::with('roles');
            return DataTables::eloquent($user)
                ->addIndexColumn()
                ->toJson();
        }

        return view('user.index');
    }

    public function create()
    {
        $role = MRole::all();
        return view('user.tambah', ['roles' => $role]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|unique:users,email',
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
                    'message' => 'berhasil menambah user'
                ]
            ]
        );
    }

    public function deleteUser($id)
    {
        $user = User::findorFail($id);
        if ($user->peserta()) {
            return response()->json([
                'code' => 400,
                'data' => [
                    'message' => 'Gagal menghapus data user karena relasi dengan data peserta'
                ]
            ]);
        }
        $user->delete();
        return response()->json(['code' => 200, 'data' => ['message' => 'berhasil menghapus data']]);
    }
}
