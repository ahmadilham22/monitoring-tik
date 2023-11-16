<?php

namespace App\Http\Controllers\DataMaster\Procurement;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\DataMaster\Procurement;

class ProcurementController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = Procurement::all();
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    return view('pages.data-master.procurement._action.procurementsAction', compact('data'));
                })->addIndexColumn()->make(true);
        }
        $data = Procurement::all();
        return view('pages.data-master.procurement.index', compact('data'));
    }

    // public function store(Request $request)
    // {
    //     $pengadaan = $request->all();

    //     if (Division::where('nama_divisi', $pengadaan)->exists()) {
    //         return redirect()->route('division.index')->with('error', 'Divisi sudah ada.');
    //     } else {
    //     }
    //     Procurement::create($pengadaan);

    //     return redirect()->route('procurement.index')->with('success', 'Divisi berhasil ditambahkan.');
    // }

    public function store(Request $request)
    {

        $pengadaanId = $request->id;

        $procurement = Procurement::updateOrCreate(
            [
                'id' => $pengadaanId
            ],
            [
                'mitra' => $request->mitra,
                'jenis_pengadaan' => $request->jenis_pengadaan,
                'tahun_pengadaan' => $request->tahun_pengadaan,
            ]
        );

        return Response()->json($procurement);
    }

    public function edit(Request $request)
    {
        $id = array('id' => $request->id);
        $procurement  = Procurement::where($id)->first();

        return Response()->json($procurement);
    }

    public function destroy(Request $request)
    {
        $procurement = Procurement::where('id', $request->id);
        $procurement->delete();
        return Response()->json($procurement);
    }
}
