<?php

namespace App\Http\Controllers\DataMaster\Division;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use App\Models\DataMaster\Division;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

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

    public function store(Request $request)
    {

        $divisiId = $request->id;

        $validator = Validator::make($request->all(), [
            'kode_divisi' => [
                'required',
                Rule::unique('divisions')->ignore($divisiId),
            ],
            'nama_divisi' => 'required',
        ], [
            'kode_divisi.required' => 'Kode divisi wajib diisi.',
            'kode_divisi.unique' => 'Kode divisi sudah ada.',
            'nama_divisi.required' => 'Nama divisi wajib diisi.',
        ]);


        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }

        try {
            $division = Division::updateOrCreate(
                [
                    'id' => $divisiId
                ],
                [
                    'kode_divisi' => $request->kode_divisi,
                    'nama_divisi' => $request->nama_divisi,
                ]
            );

            return response()->json(['success' => true, 'message' => 'Data berhasil disimpan', 'data' => $division]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['success' => false, 'message' => 'Data telah ada', 'error' => $e->getMessage()]);
        }
    }

    public function edit(Request $request)
    {
        $id = array('id' => $request->id);
        $division  = Division::where($id)->first();

        return Response()->json($division);
    }

    public function destroy(Request $request)
    {
        $division = Division::where('id', $request->id);
        $division->delete();
        return Response()->json(['data' => $division, 'message' => 'Data Berhasil di Hapus']);
    }
}