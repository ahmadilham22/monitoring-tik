<?php

namespace App\Http\Controllers\DataAssets;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\DataMaster\User;
use App\Models\DataMaster\Category;
use App\Models\DataMaster\Division;
use App\Models\DataMaster\Location;
use App\Http\Controllers\Controller;
use App\Models\DataAsset\FixedAsset;
use App\Models\DataMaster\Procurement;
use App\Models\DataMaster\SubCategory;
use App\Models\DataMaster\SpecialLocation;
use BaconQrCode\Encoder\QrCode;

class FixedAssetController extends Controller
{
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $data = FixedAsset::with(['subcategory.category', 'specificlocation.location', 'user', 'procurement'])->get();

            if ($request->input('kondisi') !== null) {
                $data = $data->where('kondisi', $request->kondisi);
            }

            // if ($request->input('kategori') !== null) {
            //     $data = $data->where('category_name', $request->kategori);
            // }

            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    return view('pages.data-asset.fixed-assets.action.fixedAssetAction', compact('data'));
                })
                ->addColumn('checkbox', function ($data) {
                    return view('pages.data-asset.fixed-assets.action.checkbox', compact('data'));
                })
                ->rawColumns(['action', 'checkbox'])
                ->addIndexColumn()->make(true);
        }

        $kondisi = FixedAsset::selectRaw('kondisi')
            ->distinct()
            ->pluck('kondisi')
            ->toArray();

        // $kondisi1 = FixedAsset::with(['category'])
        //     ->select(
        //         'categories.nama_kategori as category_name',
        //     )
        //     ->join('categories', 'fixed_assets.category_id', '=', 'categories.id')
        //     ->distinct()
        //     ->pluck('category_name')
        //     ->toArray();

        $conditions = array_combine($kondisi, $kondisi);
        // $categories = array_combine($kondisi1, $kondisi1);
        // dd($categories);

        return view('pages.data-asset.fixed-assets.index', compact('conditions'));
    }

    public function create()
    {
        $category = Category::all();
        $subCategory = SubCategory::all();
        $subCategories = SubCategory::with('category')->get();
        // dd($subCategories);
        $location = Location::all();
        $division = Division::all();
        $procurement = Procurement::all();
        $specificLocation = SpecialLocation::with('location')->get();;
        $user = User::with('division')->get();
        // dd($user);
        return view('pages.data-asset.fixed-assets.create', compact('category', 'subCategories', 'subCategory', 'location', 'specificLocation', 'procurement', 'user'));
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'sub_category_id' => 'required',
            'procurement_id' => 'required',
            'specific_location_id' => 'required',
            'user_id' => 'required',
            'kode_bmn' => 'min:5',
            'kode_sn' => 'required',
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
        $data = FixedAsset::with(['subcategory.category', 'specificlocation.location', 'user', 'procurement'])->findOrFail($id);
        // $qrcode = QrCode::($data->kode_sn);
        // dd($data);
        return view('pages.data-asset.fixed-assets.show', compact('data'));
    }

    public function destroy($id)
    {
        $data = FixedAsset::findOrFail($id);
        $data->delete();
        return view('pages.data-asset.fixed-assets.index');
    }

    public function selectCategory()
    {
        $data = Category::where('nama_kategori', 'LIKE', '%' . request('q') . '%')->paginate(10);

        return response()->json($data);
    }

    public function selectSubCategory($id)
    {
        $data = SubCategory::where('categories_id', $id)->where('nama_sub_kategori', 'LIKE', '%' . request('q') . '%')->paginate(10);

        return response()->json($data);
    }
}
