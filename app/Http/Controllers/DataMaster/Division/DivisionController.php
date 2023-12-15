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
            $data = Division::orderBy('updated_at', 'desc')->get();
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

        $rules = [
            'kode_divisi' => 'required',
            'nama_divisi' => 'required',
        ];

        // Jika ini adalah data baru, tambahkan aturan unique untuk 'kode_divisi'
        if (empty($divisiId)) {
            $rules['kode_divisi'] .= '|unique:divisions'; // Sesuaikan dengan nama tabel yang benar
        } else {
            // Jika ini adalah pengubahan data, tambahkan aturan unique, kecuali untuk data yang sedang diedit
            $rules['kode_divisi'] .= '|unique:divisions,kode_divisi,' . $divisiId;
        }

        $validator = Validator::make($request->all(), $rules, [
            'kode_divisi.required' => 'Kode divisi wajib diisi.',
            'kode_divisi.unique' => 'Kode divisi sudah ada.',
            'nama_divisi.required' => 'Nama divisi wajib diisi.',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => true, 'message' => $validator->errors()->first()]);
        }

        try {
            $division = Division::updateOrCreate(
                ['id' => $divisiId],
                [
                    'kode_divisi' => $request->kode_divisi,
                    'nama_divisi' => $request->nama_divisi,
                ]
            );

            return response()->json(['success' => true, 'message' => 'Data berhasil disimpan', 'data' => $division]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['error' => true, 'message' => 'Data telah ada', 'errors' => $e->getMessage()]);
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
