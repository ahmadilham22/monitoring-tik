<?php

namespace App\Http\Controllers\DataMaster\Procurement;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\DataMaster\Procurement;
use Illuminate\Support\Facades\Validator;

class ProcurementController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = Procurement::orderBy('updated_at', 'desc')->get();
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    return view('pages.data-master.procurement._action.procurementsAction', compact('data'));
                })->addIndexColumn()->make(true);
        }
        $data = Procurement::all();
        return view('pages.data-master.procurement.index', compact('data'));
    }

    public function store(Request $request)
    {
        $pengadaanId = $request->id;

        $rules = [
            'mitra' => 'required',
            'jenis_pengadaan' => 'required',
            'tahun_pengadaan' => 'required',
        ];

        // if (empty($pengadaanId)) {
        //     $rules['mitra'] .= '|unique:procurements';
        // } else {
        //     $rules['mitra'] .= '|unique:procurements,mitra,' . $pengadaanId;
        // }

        $validator = Validator::make($request->all(), $rules, [
            'mitra.required' => 'Mitra wajib diisi.',
            'mitra.unique' => 'Mitra sudah ada.',
            'jenis_pengadaan.required' => 'Jenis pengadaan wajib diisi.',
            'tahun_pengadaan.required' => 'Tahun pengadaan wajib diisi.',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => true, 'message' => $validator->errors()->first()]);
        }

        try {
            $procurement = Procurement::updateOrCreate(
                ['id' => $pengadaanId],
                [
                    'mitra' => $request->mitra,
                    'jenis_pengadaan' => $request->jenis_pengadaan,
                    'tahun_pengadaan' => $request->tahun_pengadaan,
                ]
            );

            return response()->json(['success' => true, 'message' => 'Data berhasil disimpan', 'data' => $procurement]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['error' => true, 'message' => 'Data telah ada', 'errors' => $e->getMessage()]);
        }
    }


    public function edit(Request $request)
    {
        $id = array('id' => $request->id);
        $procurement  = Procurement::where($id)->first();

        return Response()->json($procurement);
    }

    public function destroy(Request $request)
    {
        $procurement = Procurement::where('id', $request->id);
        $procurement->delete();
        return Response()->json(['data' => $procurement, 'message' => 'Data Berhasil di Hapus']);
    }
}