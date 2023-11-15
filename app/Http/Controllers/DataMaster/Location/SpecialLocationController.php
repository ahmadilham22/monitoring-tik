<?php

namespace App\Http\Controllers\DataMaster\Location;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\DataMaster\Location;
use App\Http\Controllers\Controller;
use App\Http\Requests\DataMaster\SpecificLocationRequest;
use App\Models\DataMaster\SpecialLocation;

class SpecialLocationController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = SpecialLocation::with(['location'])->get();
            return datatables()->of($data)
                ->addColumn('action', 'components.actions.spesificLocationAction')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        $data = Location::all();
        return view('pages.data-master.special-location.index', compact('data'));
    }

    public function store(Request $request)
    {
        $lokasi = $request->all();

        SpecialLocation::create($lokasi);

        return redirect()->route('special-location.index')->with('success', 'Lokasi berhasil ditambahkan.');
    }

    public function update(Request $request)
    {

        $locationId = $request->id;

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

        return Response()->json($location);
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
        return Response()->json($location);
    }
}
