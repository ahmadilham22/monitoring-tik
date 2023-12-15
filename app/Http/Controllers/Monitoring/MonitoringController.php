<?php

namespace App\Http\Controllers\Monitoring;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\DataAsset\FixedAsset;

class MonitoringController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            if (request()->ajax()) {
                $data = FixedAsset::with(['category', 'subcategory', 'location', 'specificLocation', 'division', 'procurement'])
                    ->select(
                        'fixed_assets.id',
                        'kode_sn',
                        'categories.nama_kategori as category_name',
                        'sub_categories.nama_sub_kategori as sub_category_name',
                        'locations.lokasi_umum',
                        'jumlah_barang',
                        'kondisi',
                        'penanggung_jawab'
                    )
                    ->join('categories', 'fixed_assets.category_id', '=', 'categories.id')
                    ->join('sub_categories', 'fixed_assets.sub_category_id', '=', 'sub_categories.id')
                    ->join('locations', 'fixed_assets.location_id', '=', 'locations.id')
                    ->get();

                return DataTables::of($data)
                    ->addColumn('action', function ($data) {
                        return view('pages.monitoring._action.monitoringAction', compact('data'));
                    })->addIndexColumn()->make(true);
            }
            return view('pages.data-asset.fixed-assets.index');
        }

        return view('pages.monitoring.index');
    }

    public function create()
    {
        return view('pages.monitoring.create');
    }
    public function edit()
    {
        return view('pages.monitoring.edit');
    }
    public function show($id)
    {
        $data = FixedAsset::with(['category', 'subcategory', 'location', 'specificLocation', 'division', 'procurement'])->findOrFail($id);

        return view('pages.monitoring.show', compact('data'));
    }
}
