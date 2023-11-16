<?php

namespace App\Http\Controllers\DataAssets;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\DataAsset\FixedAsset;
use App\Models\DataMaster\Category;
use App\Models\DataMaster\Division;
use App\Models\DataMaster\Location;
use App\Models\DataMaster\Procurement;
use App\Models\DataMaster\SpecialLocation;
use App\Models\DataMaster\SubCategory;

class FixedAssetController extends Controller
{
    public function index(Request $request)
    {
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

            if ($request->filled('kondisi')) {
                $data->where('kondisi', $request->tahun);
            }

            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    return view('pages.data-asset.fixed-assets.action.fixedAssetAction', compact('data'));
                })->addIndexColumn()->make(true);
        }
        return view('pages.data-asset.fixed-assets.index');
    }

    public function create()
    {
        $category = Category::all();
        $subCategory = SubCategory::all();
        $location = Location::all();
        $division = Division::all();
        $procurement = Procurement::all();
        $specificLocation = SpecialLocation::all();
        return view('pages.data-asset.fixed-assets.create', compact('category', 'subCategory', 'location', 'specificLocation', 'procurement', 'division'));
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'location_id' => 'required',
            'procurement_id' => 'required',
            'division_id' => 'required',
            'specific_location_id' => 'required',
            'kode_sn' => 'required',
            'jumlah_barang' => 'required',
            'penanggung_jawab' => 'required',
            'jabatan' => 'required',
            'kondisi' => 'required',
            'tahun_perolehan' => 'required',
            'keterangan' => 'required',
        ]);

        FixedAsset::create($data);

        return redirect()->route('asset-fixed.index');
    }

    public function edit()
    {
        return view('pages.data-asset.fixed-assets.edit');
    }

    public function show($id)
    {
        $data = FixedAsset::with(['category', 'subcategory', 'location', 'specificLocation', 'division', 'procurement'])->findOrFail($id);
        return view('pages.data-asset.fixed-assets.show', compact('data'));
    }

    public function destroy($id)
    {
        $data = FixedAsset::findOrFail($id);
        $data->delete();
        return view('pages.data-asset.fixed-assets.index');
    }
}
