<?php

namespace App\Http\Controllers\DataMaster\Division;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\DataMaster\Division;
use App\Http\Controllers\Controller;

class DivisionController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = Division::all();
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    return view('pages.data-master.division._action.divisionAction', compact('data'));
                })->addIndexColumn()->make(true);
        }
        $data = Division::all();
        return view('pages.data-master.division.index', compact('data'));
    }

    // public function store(Request $request)
    // {
    //     $divisi = strtoupper($request->input('nama_divisi'));

    //     if (Division::where('nama_divisi', $divisi)->exists()) {
    //         return redirect()->route('division.index')->with('error', 'Divisi sudah ada.');
    //     } else {
    //         Division::create(['nama_divisi' => $divisi]);

    //         return redirect()->route('division.index')->with('success', 'Divisi berhasil ditambahkan.');
    //     }
    // }

    public function store(Request $request)
    {

        $divisiId = $request->id;

        $division = Division::updateOrCreate(
            [
                'id' => $divisiId
            ],
            [
                'kode_divisi' => $request->kode_divisi,
                'nama_divisi' => $request->nama_divisi,
            ]
        );

        return Response()->json($division);
    }

    public function edit(Request $request)
    {
        $id = array('id' => $request->id);
        $division  = Division::where($id)->first();

        return Response()->json($division);
    }

    public function destroy(Request $request)
    {
        $location = Division::where('id', $request->id);
        $location->delete();
        return Response()->json($location);
    }
}