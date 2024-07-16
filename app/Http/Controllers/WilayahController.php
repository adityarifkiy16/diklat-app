<?php

namespace App\Http\Controllers;

use App\Models\MProvince;
use App\Models\MRegency;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    public function getProv()
    {
        $province = MProvince::all();
        return response()->json(['province' => $province]);
    }

    public function getKotaProv(Request $request)
    {
        $provId = $request->input('provId');
        $province = MProvince::with('regencies')->findOrFail($provId);
        return response()->json(['province' => $province]);
    }

    public function getKota()
    {
        $kota = MRegency::all();
        return response()->json(['kota' => $kota]);
    }
}
