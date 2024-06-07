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
use App\Models\DataMaster\History;
use App\Models\DataMaster\Procurement;
use App\Models\DataMaster\SubCategory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\DataMaster\SpecialLocation;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Ramsey\Uuid\Uuid;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class FixedAssetController extends Controller
{
    private function generateQrCode($id)
    {
        // URL yang akan di-encode dalam QR code
        $url = url("/show-public/{$id}");

        // Nama file untuk QR code
        $fileName = time() . '.' . $id . '.png';

        // Generate QR code
        $qrCode = QrCode::format('png')
            ->size(512)
            ->errorCorrection('L')
            ->generate($url);

        // Path untuk menyimpan QR code
        $qrCodePath = 'qrcodes/' . $fileName;

        // Simpan QR code ke storage
        Storage::disk('public')->put($qrCodePath, $qrCode);

        return $fileName;
    }

    public function updateSn(Request $request)
    {
        if ($request->ajax()) {
            // Validasi input
            $validator = Validator::make($request->all(), [
                'pk' => 'required|exists:fixed_assets,id',
                'value' => [
                    'nullable',
                    Rule::unique('fixed_assets', 'kode_sn')->ignore($request->pk)->whereNull('deleted_at'),
                ],
            ], [
                'pk.required' => 'Primary key is required.',
                'pk.exists' => 'The primary key must exist in the fixed assets table.',
                'value.unique' => 'Kode SN sudah ada.',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors()->all(), 422);
            }

            // Update data
            FixedAsset::find($request->pk)->update([
                'kode_sn' => $request->value
            ]);

            return response()->json(['success' => true, 'message' => 'Berhasil menyimpan data',]);
        }
    }

    public function updateBmn(Request $request)
    {
        if ($request->ajax()) {
            // Validasi input
            $validator = Validator::make($request->all(), [
                'pk' => 'required|exists:fixed_assets,id',
                'value' => [
                    'nullable',
                    Rule::unique('fixed_assets', 'kode_bmn')->ignore($request->pk)->whereNull('deleted_at'),
                ],
            ], [
                'pk.required' => 'Primary key is required.',
                'pk.exists' => 'The primary key must exist in the fixed assets table.',
                'value.unique' => 'Kode BMN sudah ada.',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors()->all(), 422);
            }

            // Update data
            FixedAsset::find($request->pk)->update([
                'kode_bmn' => $request->value
            ]);

            return response()->json(['success' => true, 'message' => 'Berhasil menyimpan data',]);
        }
    }

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
                ->addColumn('inputSn', function ($data) {
                    return view('pages.data-asset.fixed-assets.action.inputSn', compact('data'));
                })
                ->addColumn('inputBMN', function ($data) {
                    return view('pages.data-asset.fixed-assets.action.inputBMN', compact('data'));
                })
                ->rawColumns(['action', 'checkbox', 'inputSn'])
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
        $users = DB::table('users')->select('id', 'nama')->where('role', 'admin')->whereNotNull('division_id')->get();

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

    public function storeAjax(Request $request)
    {
        // Validation
        $data = Validator::make($request->all(), [
            'sub_category_id' => 'required',
            'procurement_id' => 'required',
            'specific_location_id' => 'required',
            'user_id' => 'required',
            'kode_bmn' => 'nullable',
            'kode_sn' => 'nullable|unique:fixed_assets,kode_sn,NULL,id,deleted_at,NULL',
            'kondisi' => 'required',
            'unit_id' => 'required',
            'tahun_perolehan' => 'required',
            'image' => 'nullable',
            'harga' => 'nullable',
            'keterangan' => 'nullable',
        ], [
            // 'kode_bmn.min' => 'Kode BMN minimal harus 5 karakter.',
            'kode_sn.unique' => 'Kode SN sudah ada .',
            'sub_category_id.required' => 'Kategori harus diisi.',
            'specific_location_id.required' => 'Lokasi harus diisi.',
            'procurement_id.required' => 'Mitra harus diisi.',
            'user_id.required' => 'Penanggung jawab harus diisi.',
            'unit_id.required' => 'Satuan harus diisi.',
            'kondisi.required' => 'Kondisi harus diisi.',
            'tahun_perolehan.required' => 'Tahun Perolehan harus diisi.',
        ]);

        if ($data->fails()) {
            return response()->json($data->errors()->all(), 422);
        }

        $validatedData = $data->validated();

        $uuid = Uuid::uuid4()->toString();
        $fixedAsset = null;

        DB::transaction(function () use ($validatedData, $request, $uuid, &$fixedAsset) {
            // Buat entitas FixedAsset dengan data yang telah divalidasi
            $fixedAsset = new FixedAsset($validatedData);
            $fixedAsset->id = $uuid;
            $fixedAsset->save();

            // $imagePath = null;
            // $history = History::create([
            //     'fixed_asset_id' => $fixedAsset->id,
            //     'kondisi' => $request->input('kondisi'),
            // ]);
            $historyData = [
                'fixed_asset_id' => $fixedAsset->id,
                'kondisi' => $request->input('kondisi'),
            ];
            // if ($request->hasFile('image')) {
            //     $file = $request->file('image');
            //     $filename = time() . '.' . $file->getClientOriginalName() . '.' . $file->getClientOriginalExtension();

            //     // Simpan file ke direktori storage/app/public/userImage
            //     $path = $file->storeAs('public/assetImage', $filename);

            //     // Simpan nama file yang relevan di kolom 'photo'
            //     $fixedAsset->image = $filename;
            // }
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '.' . $file->getClientOriginalName() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('public/assetImage', $filename);
                $historyData['image'] = $filename;
                // $imagePath = $filename;
            }

            // Simpan data riwayat kondisi ke tabel histories
            History::create($historyData);

            // Configure QR-Code
            $fileName = $this->generateQrCode($fixedAsset->id);

            $fixedAsset->update(['qrcode' => $fileName]);
        });

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
                'nullable',
                Rule::unique('fixed_assets')->ignore($request->id)->whereNull('deleted_at'),
            ],
            'kondisi' => 'required',
            'unit_id' => 'required',
            'tahun_perolehan' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'harga' => 'nullable',
            'keterangan' => 'nullable',
        ], [
            'kode_sn.unique' => 'Kode SN sudah ada.',
            'sub_category_id.required' => 'Kategori harus diisi.',
            'specific_location_id.required' => 'Lokasi harus diisi.',
            'procurement_id.required' => 'Mitra harus diisi.',
            'user_id.required' => 'Penanggung jawab harus diisi.',
            'unit_id.required' => 'Satuan harus diisi.',
            'kondisi.required' => 'Kondisi harus diisi.',
            'tahun_perolehan.required' => 'Tahun Perolehan harus diisi.',
        ]);

        $aset = FixedAsset::findOrFail($id);

        $historyData = [
            'fixed_asset_id' => $aset->id,
            'kondisi' => $request->input('kondisi'),
        ];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalName() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/assetImage', $filename);

            $historyData['image'] = $filename;
        }

        if (($request->kondisi != $aset->kondisi) || $request->hasFile('image')) {
            History::create($historyData);
        }
        // Lakukan pembaruan data lainnya
        $aset->update($validatedData);

        return redirect()->route('asset-fixed.index')->with('success', 'Berhasil mengubah data');
    }

    public function show($id)
    {
        $data = FixedAsset::with(['subcategory.category', 'specificlocation.location', 'user', 'procurement', 'unit', 'histories'])->findOrFail($id);
        $latestHistory = $data->histories->sortByDesc('created_at')->first();
        return view('pages.data-asset.fixed-assets.show', compact('data', 'latestHistory'));
    }

    public function destroy(Request $request, $id)
    {
        $fixedAsset = FixedAsset::findOrFail($id);

        $qrCodePath = "public/qrcodes/{$fixedAsset->qrcode}";

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
            $qrCodePath = $data->qrcode;
            $fileName = basename($qrCodePath);

            return response()->download(storage_path('app/public/qrcodes/' . $qrCodePath), $fileName);
        }

        return response()->json(['error' => 'QR Code not found'], 404);
    }

    public function DownloadQrCodeLocation($id)
    {
        $data = FixedAsset::with('specificlocation')->findOrFail($id);

        if ($data) {
            $qrCodePath = $data->specificlocation->qrcode;
            $fileName = basename($qrCodePath);

            return response()->download(storage_path('app/public/qrcodes/locations/' . $qrCodePath), $fileName);
        }

        return response()->json(['error' => 'QR Code not found'], 404);
    }

    public function downloadSelectedQrCodes(Request $request)
    {
        $selectedIds = $request->input('selectedIds');
        $zipFileName = 'selected_qrcodes.zip';
        $zipFilePath = storage_path('app/' . $zipFileName);

        $zip = new ZipArchive;
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            foreach ($selectedIds as $id) {
                // Ambil data fixed asset berdasarkan ID
                $fixedAsset = FixedAsset::with('specificlocation')->find($id);

                if ($fixedAsset && $fixedAsset->qrcode) {
                    // Dapatkan path QR code dari field qrcode di database
                    $qrCodePath = storage_path('app/public/qrcodes/' . $fixedAsset->qrcode);
                    $qrCodePathlocations = null;

                    if ($fixedAsset->specificlocation) {
                        $qrCodePathlocations = storage_path('app/public/qrcodes/locations/' . $fixedAsset->specificlocation->qrcode);
                    }

                    // Tambahkan file QR code ke ZIP archive jika ada
                    if (Storage::exists('public/qrcodes/' . $fixedAsset->qrcode)) {
                        $zip->addFile($qrCodePath, 'qrcodes/' . $fixedAsset->qrcode);
                    } else {
                        Log::error("QR code file not found for fixed asset: {$fixedAsset->qrcode}");
                    }

                    if ($qrCodePathlocations && Storage::exists('public/qrcodes/locations/' . $fixedAsset->specificlocation->qrcode)) {
                        $zip->addFile($qrCodePathlocations, 'qrcodes/locations/' . $fixedAsset->specificlocation->qrcode);
                    } else {
                        Log::error("Location QR code file not found for specific location: {$fixedAsset->specificlocation->qrcode}");
                    }
                }
            }
            $zip->close();
        } else {
            Log::error('Failed to create zip file');
            return response()->json(['error' => 'Failed to create zip file'], 500);
        }

        return response()->json(['success' => true, 'zipFilePath' => $zipFilePath]);
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