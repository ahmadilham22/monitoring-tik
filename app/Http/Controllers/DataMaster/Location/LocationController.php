<?php

namespace App\Http\Controllers\DataMaster\Location;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use App\Models\DataMaster\Location;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\DataMaster\LocationRequest;

class LocationController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = Location::all();
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    return view('pages.data-master.location._action.locationAction', compact('data'));
                })->addIndexColumn()->make(true);
        }
        $data = Location::all();
        return view('pages.data-master.location.index', compact('data'));
    }

    public function store(Request $request)
    {
        $locationId = $request->id;
        $validator = Validator::make($request->all(), [
            'kode_lokasi' => [
                'required',
                Rule::unique('locations')->ignore($locationId),
            ],
            'lokasi_umum' => 'required',
        ], [
            'kode_lokasi.required' => 'Kode lokasi wajib diisi',
            'kode_lokasi.unique' => 'Kode lokasi sudah ada',
            'lokasi_umum.required' => 'Nama lokasi wajib diisi',
        ]);


        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }

        try {
            $location = Location::updateOrCreate(
                [
                    'id' => $locationId
                ],
                [
                    'kode_lokasi' => $request->kode_lokasi,
                    'lokasi_umum' => $request->lokasi_umum,
                ]
            );

            return response()->json(['success' => true, 'message' => 'Data berhasil disimpan', 'data' => $location]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['success' => false, 'message' => 'Data telah ada', 'error' => $e->getMessage()]);
        }
    }

    public function edit(Request $request)
    {
        $id = array('id' => $request->id);
        $location  = Location::where($id)->first();
        return response()->json($location);
    }

    public function destroy(Request $request)
    {
        $location = Location::where('id', $request->id);
        $location->delete();
        return Response()->json(['data' => $location, 'message' => 'Data Berhasil di Hapus']);
    }
}
