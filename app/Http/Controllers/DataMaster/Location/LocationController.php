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
            $data = Location::orderBy('updated_at', 'desc')->get();
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

        $isNewRecord = empty($locationId); // Periksa apakah permintaan adalah untuk pembuatan data baru

        $rules = [
            'kode_lokasi' => 'required',
            'lokasi_umum' => 'required',
        ];

        // Validasi tambahan untuk pembuatan data baru
        if ($isNewRecord) {
            $rules['kode_lokasi'] .= '|unique:locations'; // Tambahkan aturan unique hanya untuk pembuatan data baru
        } else {
            // Validasi tambahan untuk perubahan data yang sudah ada
            $rules['kode_lokasi'] .= '|unique:locations,kode_lokasi,' . $locationId; // Jangan periksa data itu sendiri
        }

        $validator = Validator::make($request->all(), $rules, [
            'kode_lokasi.required' => 'Kode lokasi wajib diisi',
            'kode_lokasi.unique' => 'Kode lokasi sudah ada',
            'lokasi_umum.required' => 'Nama lokasi wajib diisi',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => true, 'message' => $validator->errors()->first()]);
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
            return response()->json(['error' => true, 'message' => 'Data telah ada', 'errors' => $e->getMessage()]);
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
