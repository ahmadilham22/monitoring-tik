<?php

namespace App\Http\Controllers\DataAssets;

use ZipArchive;
use Illuminate\Http\Request;
use App\Models\DataMaster\User;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Models\DataMaster\Category;
use App\Models\DataMaster\Division;
use App\Models\DataMaster\Location;
use App\Http\Controllers\Controller;
use App\Models\DataAsset\FixedAsset;
use App\Models\DataMaster\Procurement;
use App\Models\DataMaster\SubCategory;
use Illuminate\Support\Facades\Storage;
use App\Models\DataMaster\SpecialLocation;
use App\Models\DataMaster\Unit;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class FixedAssetController extends Controller
{
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $data = FixedAsset::with(['subcategory.category', 'specificlocation.location', 'user', 'procurement'])->orderBy('updated_at', 'desc')->get();

            if ($request->input('kondisi') !== null) {
                $data = $data->where('kondisi', $request->kondisi);
            }

            if ($request->input('kategori') !== null) {
                $data = $data->where('subcategory.categories_id', $request->kategori);
            }

            // if ($kategori !== null) {
            //     $data = $data->where('subcategory.categories_id', $kategori);
            // }

            if ($request->input('pj') !== null) {
                $data = $data->where('user.id', $request->pj);
            }

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
        $conditions = array_combine($kondisi, $kondisi);
        $subcategories = DB::table('sub_categories AS sc')
            ->join('categories AS c', 'sc.categories_id', '=', 'c.id')
            ->select('sc.categories_id as id', DB::raw('MAX(sc.nama_sub_kategori) as nama_sub_kategori'), DB::raw('MAX(c.nama_kategori) as nama_kategori'))
            ->groupBy('sc.categories_id')
            ->get();
        $users = DB::table('users')
            ->select('id', 'nama')
            ->where('role', 'admin')
            ->get();

        return view('pages.data-asset.fixed-assets.index', compact('conditions', 'users', 'subcategories'));
    }

    public function create()
    {
        $category = Category::all();
        $subCategory = SubCategory::all();
        $subCategories = SubCategory::with('category')->get();
        $location = Location::all();
        $division = Division::all();
        $unit = Unit::all();
        $procurement = Procurement::all();
        $specificLocation = SpecialLocation::with('location')->get();;
        $user = User::with('division')->where('role', 'admin')->whereNotNull('division_id')->get();
        return view('pages.data-asset.fixed-assets.create', compact('category', 'subCategories', 'subCategory', 'location', 'specificLocation', 'procurement', 'user', 'unit'));
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

        $fixedAsset = FixedAsset::create($data);
        $url = "http://127.0.0.1:8000/report/show/" . $fixedAsset->id;


        $fileName = $data['kode_sn'] . '.png';
        $qrCode = QrCode::format('png')
            ->size(500)
            ->errorCorrection('H')
            ->generate($url);

        $qrCodePath = 'qrcodes/' . $fileName;
        Storage::disk('public')->put($qrCodePath, $qrCode);
        $fixedAsset->update(['qr_code_path' => $qrCodePath]);


        return redirect()->route('asset-fixed.index');
    }

    public function storeAjax(Request $request)
    {
        $data = Validator::make($request->all(), [
            'sub_category_id' => 'required',
            'procurement_id' => 'required',
            'specific_location_id' => 'required',
            'user_id' => 'required',
            'kode_bmn' => 'min:5',
            'kode_sn' => 'required|unique:fixed_assets,kode_sn',
            'kondisi' => 'required',
            'unit_id' => 'required',
            'tahun_perolehan' => 'required',
            'keterangan' => 'required',
        ], [
            'sub_category_id.required' => 'Kategori harus diisi.',
            'procurement_id.required' => 'Pengadaan harus diisi.',
            'specific_location_id.required' => 'Lokasi harus diisi.',
            'user_id.required' => 'Penanggung jawab harus diisi.',
            'unit_id.required' => 'Satuan harus diisi.',
            'kode_bmn.min' => 'Kode BMN minimal harus 5 karakter.',
            'kode_sn.required' => 'Kode SN harus diisi.',
            'kode_sn.unique' => 'Kode SN sudah ada .',
            'kondisi.required' => 'Kondisi harus diisi.',
            'tahun_perolehan.required' => 'Tahun Perolehan harus diisi.',
            'keterangan.required' => 'Keterangan harus diisi.',
        ]);

        if ($data->fails()) {
            return response()->json(['success' => false, 'message' => $data->errors()->first()]);
        }

        $validatedData = $data->validated();

        // Buat entitas FixedAsset dengan data yang telah divalidasi
        $fixedAsset = FixedAsset::create($validatedData);

        $url = "http://127.0.0.1:8000/report/show/" . $fixedAsset->id;


        $fileName = $request->input('kode_sn') . '.png';
        $qrCode = QrCode::format('png')
            ->size(500)
            ->errorCorrection('H')
            ->generate($url);

        $qrCodePath = 'qrcodes/' . $fileName;
        Storage::disk('public')->put($qrCodePath, $qrCode);
        $fixedAsset->update(['qr_code_path' => $qrCodePath]);


        return response()->json(['success' => true, 'message' => 'Berhasil menyimpan data', 'data' => $fixedAsset]);
    }

    public function edit($id)
    {
        $aset = FixedAsset::findOrFail($id);
        $subCategories = SubCategory::with('category')->get();
        $procurement = Procurement::all();
        $specificLocation = SpecialLocation::with('location')->get();;
        $user = User::with('division')->whereNotNull('division_id')->get();
        $assets = FixedAsset::all();
        $unit = Unit::all();
        return view('pages.data-asset.fixed-assets.edit', compact('subCategories', 'specificLocation', 'procurement', 'user', 'aset', 'unit'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->validate($request, [
            'sub_category_id' => 'required',
            'procurement_id' => 'required',
            'specific_location_id' => 'required',
            'user_id' => 'required',
            'unit_id' => 'required',
            'kode_bmn' => 'min:5',
            'kode_sn' => 'required',
            'kondisi' => 'required',
            'tahun_perolehan' => 'required',
            'keterangan' => 'required',
        ]);
        $aset = FixedAsset::findOrFail($id);

        $aset->update($data);
        return redirect()->route('asset-fixed.index')->with('success', 'Berhasil mengubah data');
    }

    public function show($id)
    {
        $data = FixedAsset::with(['subcategory.category', 'specificlocation.location', 'user', 'procurement'])->findOrFail($id);

        $folderPath = storage_path('app/public/qrcodes/');
        $qrCodePath = $folderPath . $data->kode_sn . '.png';
        return view('pages.data-asset.fixed-assets.show', compact('data', 'qrCodePath'));
    }

    public function destroy(Request $request, $id)
    {
        $fixedAsset = FixedAsset::where('id', $request->id);
        $fixedAsset->delete();
        return Response()->json(['data' => $fixedAsset, 'message' => 'Data Berhasil di Hapus']);
    }

    public function DeleteSelectedAsset(Request $request)
    {
        $asset = $request->fixedasset_id;
        FixedAsset::whereIn('id', $asset)->delete();
        return response()->json(['success' => true, 'message' => 'Berhasil menghapus data']);
    }

    public function DownloadQrCode($id)
    {
        $data = FixedAsset::find($id);

        if ($data) {
            $qrCodePath = $data->kode_sn . '.png';
            $fileName = basename($qrCodePath);

            return response()->download(storage_path('app/public/qrcodes/' . $qrCodePath), $fileName);
        }

        return response()->json(['error' => 'QR Code not found'], 404);
    }

    public function downloadSelectedQrCodes(Request $request)
    {

        $selectedIds = $request->input('selectedIds');
        $zip = new ZipArchive;
        $zipFileName = 'selected_qrcodes.zip';
        $zipFilePath = storage_path('app/' . $zipFileName);

        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE)) {
            foreach ($selectedIds as $id) {
                // Ganti dengan path yang sesuai dengan folder Anda
                $qrCodePath = storage_path('app/public/qrcodes/' . $id . '.png');

                if (file_exists($qrCodePath)) {
                    $zip->addFile($qrCodePath, $id . '.png');
                }
            }
            $zip->close();
        }

        if (file_exists($zipFilePath)) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => 'No QR codes found or ZIP creation failed'], 404);
        }
    }

    public function downloadSelectedQrCodesZip()
    {
        $zipFileName = 'selected_qrcodes.zip';
        $zipFilePath = storage_path('app/' . $zipFileName);

        if (file_exists($zipFilePath)) {
            return response()->download($zipFilePath, $zipFileName)->deleteFileAfterSend(true);
        } else {
            return response()->json(['error' => 'ZIP file not found'], 404);
        }
    }
}
