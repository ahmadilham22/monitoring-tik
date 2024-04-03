<?php

namespace App\Http\Controllers\DataAssets;

use App\Exports\FixedAsset\MultipleSheetTemplateExport;
use App\Exports\FixedAsset\TemplateExport;
use App\Imports\AssetImport;
use App\Imports\MultipleSheetImport;
use ZipArchive;
use Illuminate\Http\Request;
use App\Models\DataMaster\Unit;
use App\Models\DataMaster\User;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Models\DataMaster\Category;
use App\Models\DataMaster\Division;
use App\Models\DataMaster\Location;
use App\Http\Controllers\Controller;
use App\Models\DataAsset\FixedAsset;
use App\Models\DataMaster\Procurement;
use App\Models\DataMaster\SubCategory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\DataMaster\SpecialLocation;
use Maatwebsite\Excel\Facades\Excel;
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
        $url = url("/report/show{$fixedAsset->id}");


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
        // Validation
        $data = Validator::make($request->all(), [
            'sub_category_id' => 'required',
            'procurement_id' => 'required',
            'specific_location_id' => 'required',
            'user_id' => 'required',
            'kode_bmn' => 'nullable|min:5',
            'kode_sn' => 'required|unique:fixed_assets,kode_sn,NULL,id,deleted_at,NULL',
            'kondisi' => 'required',
            'unit_id' => 'required',
            'tahun_perolehan' => 'required',
            'image' => 'nullable',
            'harga' => 'nullable',
            'keterangan' => 'nullable',
        ], [
            'sub_category_id.required' => 'Kategori harus diisi.',
            'procurement_id.required' => 'Mitra harus diisi.',
            'specific_location_id.required' => 'Lokasi harus diisi.',
            'user_id.required' => 'Penanggung jawab harus diisi.',
            'unit_id.required' => 'Satuan harus diisi.',
            'kode_bmn.min' => 'Kode BMN minimal harus 5 karakter.',
            'kode_sn.required' => 'Kode SN harus diisi.',
            'kode_sn.unique' => 'Kode SN sudah ada .',
            'kondisi.required' => 'Kondisi harus diisi.',
            'tahun_perolehan.required' => 'Tahun Perolehan harus diisi.',
        ]);

        if ($data->fails()) {
            return response()->json(['success' => false, 'message' => $data->errors()->first()]);
        }

        $validatedData = $data->validated();


        // Buat entitas FixedAsset dengan data yang telah divalidasi
        $fixedAsset = FixedAsset::create($validatedData);


        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalName() . '.' . $file->getClientOriginalExtension();

            // Simpan file ke direktori storage/app/public/userImage
            $path = $file->storeAs('public/assetImage', $filename);

            // Simpan nama file yang relevan di kolom 'photo'
            $fixedAsset->image = $filename;
            $fixedAsset->save();
        }

        // Configure QR-Code
        $url = url("/data-assets/report/show/{$fixedAsset->id}");
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
        $validatedData = $request->validate([
            'sub_category_id' => 'required',
            'procurement_id' => 'required',
            'specific_location_id' => 'required',
            'user_id' => 'required',
            'kode_bmn' => 'nullable|min:5',
            'kode_sn' => [
                'required',
                Rule::unique('fixed_assets')->ignore($request->id)->whereNull('deleted_at'),
            ],
            'kondisi' => 'required',
            'unit_id' => 'required',
            'tahun_perolehan' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'harga' => 'nullable',
            'keterangan' => 'nullable',
        ], [
            'sub_category_id.required' => 'Kategori harus diisi.',
            'procurement_id.required' => 'Mitra harus diisi.',
            'specific_location_id.required' => 'Lokasi harus diisi.',
            'user_id.required' => 'Penanggung jawab harus diisi.',
            'unit_id.required' => 'Satuan harus diisi.',
            'kode_bmn.min' => 'Kode BMN minimal harus 5 karakter.',
            'kode_sn.required' => 'Kode SN harus diisi.',
            'kode_sn.unique' => 'Kode SN sudah ada.',
            'kondisi.required' => 'Kondisi harus diisi.',
            'tahun_perolehan.required' => 'Tahun Perolehan harus diisi.',
        ]);

        $aset = FixedAsset::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($aset->image) {
                Storage::delete('public/assetImage/' . $aset->image);
            }

            $file = $request->file('image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/assetImage', $filename);

            $aset->image = $filename;
        }

        // Lakukan pembaruan data lainnya
        $aset->update($validatedData);

        return redirect()->route('asset-fixed.index')->with('success', 'Berhasil mengubah data');
    }

    public function show($kode_sn)
    {
        $data = FixedAsset::with(['subcategory.category', 'specificlocation.location', 'user', 'procurement', 'unit'])
            ->where('kode_sn', $kode_sn)
            ->firstOrFail();
        $folderPath = storage_path('app/public/qrcodes/');
        $qrCodePath = $folderPath . $data->kode_sn . '.png';
        return view('pages.data-asset.fixed-assets.show', compact('data', 'qrCodePath'));
    }

    public function destroy(Request $request, $id)
    {
        $fixedAsset = FixedAsset::findOrFail($id);

        $kodeSn = $fixedAsset->kode_sn;
        $qrCodePath = "public/qrcodes/{$kodeSn}.png";
        if (Storage::exists($qrCodePath)) {
            Storage::delete($qrCodePath);
        }

        // Menghapus gambar dari penyimpanan lokal jika ada
        if (!empty($fixedAsset->image)) {
            Storage::delete('public/assetImage/' . $fixedAsset->image);
        }

        // Menghapus entri dari database
        $fixedAsset->delete();
        return Response()->json(['data' => $fixedAsset, 'message' => 'Data Berhasil di Hapus']);
    }

    public function DeleteSelectedAsset(Request $request)
    {
        $assetIds = $request->fixedasset_id;

        // Loop melalui setiap ID aset yang akan dihapus
        foreach ($assetIds as $assetId) {
            // Temukan aset berdasarkan ID
            $fixedAsset = FixedAsset::findOrFail($assetId);

            // Menghapus gambar dari penyimpanan lokal jika ada
            if (!empty($fixedAsset->image)) {
                Storage::delete('public/assetImage/' . $fixedAsset->image);
            }

            // Menghapus QR code dari penyimpanan lokal jika ada
            $kodeSn = $fixedAsset->kode_sn;
            $qrCodePath = "public/qrcodes/{$kodeSn}.png";
            if (Storage::exists($qrCodePath)) {
                Storage::delete($qrCodePath);
            }

            // Menghapus entri dari database
            $fixedAsset->delete();
        }

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

    public function import(Request $request)
    {
        $file = $request->file('file');
        $namaFile = $file->getClientOriginalName();
        $path = public_path('/storage/AssetExcel/' . $namaFile);
        $file->move('storage/AssetExcel', $namaFile);

        try {
            Excel::import(new MultipleSheetImport(), $path);

            return redirect()->back()->with(
                'success',
                'Data berhasil diimpor.'
            );
        } catch (\Exception $e) {
            return redirect()->back()->with(
                'error',
                'Terjadi kesalahan saat mengimpor data: ' . $e->getMessage()
            );
        }
    }

    public function exportTemplate()
    {
        return new MultipleSheetTemplateExport;
    }
}
