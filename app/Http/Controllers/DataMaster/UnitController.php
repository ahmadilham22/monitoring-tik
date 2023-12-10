<?php

namespace App\Http\Controllers\DataMaster;

use Illuminate\Http\Request;
use App\Models\DataMaster\Unit;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UnitController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = Unit::all();
            // $data = Unit::orderBy('updated_at', 'desc')->get();
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    return view('pages.data-master.unit._action.unitAction', compact('data'));
                })->addIndexColumn()->make(true);
        }
        // $data = Unit::orderBy('updated_at', 'desc')->get();
        // dd($data);
        return view('pages.data-master.unit.index');
    }

    public function store(Request $request)
    {
        $unitId = $request->id;

        $rules = [
            'nama' => 'required',
        ];

        // Jika ini adalah data baru, tambahkan aturan unique untuk 'nama'
        if (empty($unitId)) {
            $rules['nama'] .= '|unique:units'; // Sesuaikan dengan nama tabel yang benar
        } else {
            // Validasi tambahan untuk perubahan data yang sudah ada
            $rules['nama'] .= '|unique:units,nama,' . $unitId; // Jangan periksa data itu sendiri
        }

        $validator = Validator::make($request->all(), $rules, [
            'nama.required' => 'Nama wajib diisi.',
            'nama.unique' => 'Nama sudah ada.',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => true, 'message' => $validator->errors()->first()]);
        }

        try {
            $unit = Unit::updateOrCreate(
                ['id' => $unitId],
                ['nama' => $request->nama]
            );

            return response()->json(['success' => true, 'message' => 'Data berhasil disimpan', 'data' => $unit]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['error' => true, 'message' => 'Data telah ada', 'errors' => $e->getMessage()]);
        }
    }


    public function edit(Request $request)
    {
        $id = array('id' => $request->id);
        $unit  = Unit::where($id)->first();
        return response()->json($unit);
    }

    public function destroy(Request $request)
    {
        $unit = Unit::where('id', $request->id);
        $unit->delete();
        return Response()->json(['data' => $unit, 'message' => 'Data Berhasil di Hapus']);
    }
}
