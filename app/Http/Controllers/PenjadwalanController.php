<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\TPenjadwalan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PenjadwalanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $query = DB::table('TPenjadwalan')
            //     ->leftJoin('MDiklat', 'TPenjadwalan.diklat_id', '=', 'MDiklat.id')
            //     ->select(
            //         'TPenjadwalan.*',
            //         'MDiklat.*',
            //         DB::raw('DATE_FORMAT(TPenjadwalan.tgl_mulai, "%H:%i %p") as start_time'),
            //         DB::raw('DATE_FORMAT(TPenjadwalan.tgl_selesai, "%H:%i %p") as end_time')
            //     )->get();

            // get data diklat dengan format tanggal
            $query = TPenjadwalan::with(['diklat', 'instruct'])->select(
                'TPenjadwalan.*',
                DB::raw('DATE_FORMAT(TPenjadwalan.tgl_mulai, "%H:%i %p") as start_time'),
                DB::raw('DATE_FORMAT(TPenjadwalan.tgl_selesai, "%H:%i %p") as end_time')
            )->get();

            if ($query->isEmpty()) {
                return response()->json([
                    'penjadwalan' => [],
                    'code' => 404,
                    'message' => 'No data found'
                ]);
            }

            return response()->json([
                'penjadwalan' => $query,
                'code' => 200
            ]);
        }

        return view('penjadwalan.index');
    }

    public function create()
    {
        $diklat = DB::select('SELECT id, name FROM MDiklat');
        $instructor = DB::select('SELECT id, name FROM MInstructor');
        return view('penjadwalan.create', [
            'diklats' => $diklat,
            'instructors' => $instructor
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'tgl_jadwal' => 'required|string',
            'diklat_id' => 'required|exists:MDiklat,id',
            'instruc_id' => 'required|exists:MInstructor,id'
        ];

        $messages = [
            'tgl_jadwal.required' => 'Tanggal Mulai harus diisi.',
            'tgl_jadwal.after_or_equal' => 'Tanggal Mulai tidak boleh kurang dari hari ini.',
            'diklat_id.required' => 'Diklat harus dipilih.',
            'diklat_id.exists' => 'Diklat yang dipilih tidak valid.',
            'instruc_id.required' => 'Instruktur harus dipilih.',
            'instruc_id.exists' => 'Instruktur yang dipilih tidak valid.'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            // Return validation errors in JSON format
            return response()->json([
                'code' => 422,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();

        // break to an array
        list($start, $end) = explode(' - ', $data['tgl_jadwal']);

        // create format using carbon
        $data['tgl_mulai'] = Carbon::createFromFormat('m/d/Y h:i a', $start);
        $data['tgl_selesai'] = Carbon::createFromFormat('m/d/Y h:i a', $end);
        $data['instruct_id'] = $data['instruc_id'];

        TPenjadwalan::create($data);
        return response()->json([
            'code' => 200,
            'data' => [
                'message' => 'Penjadwalan berhasil ditambahkan.'
            ]
        ]);
    }
}
