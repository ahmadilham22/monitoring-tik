<?php

namespace App\Http\Controllers\DataMaster\Location;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\DataMaster\LocationRequest;
use App\Models\DataMaster\Location;

class LocationController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            return datatables()->of(Location::select('*'))
                ->addColumn('action', 'pages.data-master.location._action.locationAction')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        $data = Location::all();
        return view('pages.data-master.location.index', compact('data'));
    }

    // public function store(Request $request)
    // {
    //     $lokasi = strtoupper($request->input('lokasi_umum'));

    //     if (Location::where('lokasi_umum', $lokasi)->exists()) {
    //         return redirect()->route('location.index')->with('error', 'Lokasi sudah ada.');
    //     } else {
    //         Location::create(['lokasi_umum' => $lokasi]);

    //         return redirect()->route('location.index')->with('success', 'Lokasi berhasil ditambahkan.');
    //     }
    // }

    public function store(Request $request)
    {
        try {
            $locationId = $request->id;
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
        } catch (\Exception $e) {
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
        return Response()->json($location);
    }
}