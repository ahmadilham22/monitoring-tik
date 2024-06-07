<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Models\DataMaster\User;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Models\DataMaster\Category;
use App\Exports\Report\ReportExport;
use App\Http\Controllers\Controller;
use App\Models\DataAsset\FixedAsset;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\DataMaster\SubCategory;

class ReportController extends Controller
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

            if ($request->input('periode') !== null) {
                $data = $data->where('tahun_perolehan', $request->periode);
            }

            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    return view('pages.report._action.reportAction', compact('data'));
                })
                ->addColumn('checkbox', function ($data) {
                    return view('pages.report._action.chechbox', compact('data'));
                })
                ->rawColumns(['action', 'checkbox'])
                ->addIndexColumn()->make(true);
        }

        $data = FixedAsset::query()->with(['subcategory.category', 'specificlocation.location', 'user', 'procurement'])->get();
        // return $data;


        $kondisi = FixedAsset::selectRaw('kondisi')
            ->distinct()
            ->pluck('kondisi')
            ->toArray();

        $subcategories = DB::table('sub_categories AS sc')
            ->join('categories AS c', 'sc.categories_id', '=', 'c.id')
            ->select('sc.categories_id as id', DB::raw('MAX(sc.nama_sub_kategori) as nama_sub_kategori'), DB::raw('MAX(c.nama_kategori) as nama_kategori'))
            ->groupBy('sc.categories_id')
            ->get();

        $users = DB::table('users')->select('id', 'nama')->where('role', 'admin')->whereNotNull('division_id')->get();
        $periode = FixedAsset::selectRaw('tahun_perolehan')->distinct()->pluck('tahun_perolehan')->toArray();

        $conditions = array_combine($kondisi, $kondisi);
        $periods = array_combine($periode, $periode);

        return view('pages.report.index', compact('conditions', 'users', 'subcategories', 'periods'));
    }

    public function listPublic(Request $request)
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

            if ($request->query('kode_lokasi')) {
                // $data = $data->whereHas('specificlocation', function ($query) use ($request) {
                //     $query->where('kode_lokasi', $request->query('kode_lokasi'));
                // });
                $data = $data->where('specificlocation.kode_lokasi', $request->query('kode_lokasi'));
                // dd($data);
            }

            return DataTables::of($data)
                // ->addColumn('action', function ($data) {
                //     return view('pages.data-asset.fixed-assets.action.fixedAssetAction', compact('data'));
                // })
                // ->addColumn('checkbox', function ($data) {
                //     return view('pages.data-asset.fixed-assets.action.checkbox', compact('data'));
                // })
                // ->addColumn('inputSn', function ($data) {
                //     return view('pages.data-asset.fixed-assets.action.inputSn', compact('data'));
                // })
                // ->addColumn('inputBMN', function ($data) {
                //     return view('pages.data-asset.fixed-assets.action.inputBMN', compact('data'));
                // })
                // ->rawColumns(['action', 'checkbox', 'inputSn'])
                ->addIndexColumn()
                ->make(true);
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

        return view('pages.report.list-public', compact('conditions', 'users', 'subcategories'));
    }

    public function create()
    {
        return view('pages.report.create');
    }
    public function edit()
    {
    }

    public function show($id)
    {
        $data = FixedAsset::with(['subcategory.category', 'specificlocation.location', 'user', 'procurement', 'unit', 'histories'])->findOrFail($id);

        $latestHistory = $data->histories->sortByDesc('created_at')->first();
        // dd($latestHistory);
        // $folderPath = storage_path('app/public/qrcodes/');
        // $qrCodePath = $folderPath . $data->kode_sn . '.png';
        return view('pages.report.show', compact('data', 'latestHistory'));
    }

    public function showPublic($id)
    {
        $data = FixedAsset::with(['subcategory.category', 'specificlocation.location', 'user', 'procurement', 'unit', 'histories'])->findOrFail($id);

        $latestHistory = $data->histories->sortByDesc('created_at')->first();
        $fixedAsset = FixedAsset::find($id);
        // dd($fixedAsset);
        // dd($data->specificlocation->qrcode);
        return view('pages.report.show-public', compact('data', 'latestHistory'));
    }

    public function export(Request $request)
    {
        // Mengambil data dari query params
        $kategori = $request->query('kategori');
        $kondisi = $request->query('kondisi');
        $pj = $request->query('pj');
        $periode = $request->query('periode');
        $id = $request->query('sn');

        // Cek sn jika ada maka jadikan array jika tidak jadikan array kosong
        if ($id) {
            $idArray = explode(',', $id);
        } else {
            $idArray = [];
        }

        // memasukan variabel kedalam suatu array
        $params = [$kategori, $kondisi, $pj, $idArray, $periode];
        // dd($params);
        return Excel::download(new ReportExport($params), 'data.xlsx');
    }
}
