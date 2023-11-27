<?php

namespace App\Http\Controllers\DataMaster\Location;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use App\Models\DataMaster\Location;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\DataMaster\SpecialLocation;
use App\Http\Requests\DataMaster\SpecificLocationRequest;

class SpecialLocationController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = SpecialLocation::with(['location'])->get();
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    return view('pages.data-master.special-location._action.spesificLocationAction', compact('data'));
                })->addIndexColumn()->make(true);
        }
        $data = Location::all();
        return view('pages.data-master.special-location.index', compact('data'));
    }

    public function store(Request $request)
    {
        $locationId = $request->id;
        $validator = Validator::make($request->all(), [
            'location_id' => 'required',
            'kode_lokasi' => [
                'required',
                Rule::unique('locations')->ignore($locationId),
            ],
            'lokasi_khusus' => 'required',
        ], [
            'location_id.required' => 'Lokasi harus diisi',
            'kode_lokasi.required' => 'Kode lokasi wajib diisi',
            'kode_lokasi.unique' => 'Kode lokasi sudah ada',
            'lokasi_khusus.required' => 'Nama sub lokasi wajib diisi',
        ]);


        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }

        try {
            $location = SpecialLocation::updateOrCreate(
                [
                    'id' => $locationId
                ],
                [
                    'kode_lokasi' => $request->kode_lokasi,
                    'location_id' => $request->location_id,
                    'lokasi_khusus' => $request->lokasi_khusus,
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
        $location  = SpecialLocation::where($id)->first();

        return Response()->json($location);
    }

    public function destroy(Request $request)
    {
        $location = SpecialLocation::where('id', $request->id);
        $location->delete();
        return Response()->json(['data' => $location, 'message' => 'Data Berhasil di Hapus']);
    }
}
