<?php

namespace App\Http\Controllers\DataMaster\Division;

use App\Http\Controllers\Controller;
use App\Models\DataMaster\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            return datatables()->of(Division::select('*'))
                ->addColumn('action', 'components.actions.divisionAction')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        $data = Division::all();
        return view('pages.data-master.division.index', compact('data'));
    }

    public function store(Request $request)
    {
        $divisi = strtoupper($request->input('nama_divisi'));

        if (Division::where('nama_divisi', $divisi)->exists()) {
            return redirect()->route('division.index')->with('error', 'Divisi sudah ada.');
        } else {
            Division::create(['nama_divisi' => $divisi]);

            return redirect()->route('division.index')->with('success', 'Divisi berhasil ditambahkan.');
        }
    }

    public function update(Request $request)
    {

        $divisiId = $request->id;

        $division = Division::updateOrCreate(
            [
                'id' => $divisiId
            ],
            [
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