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
