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

    public function create()
    {
        return view('pages.report.create');
    }
    public function edit()
    {
    }
    public function show($kode_sn)
    {
        $data = FixedAsset::with(['subcategory.category', 'specificlocation.location', 'user', 'procurement', 'unit'])
            ->where('kode_sn', $kode_sn)
            ->firstOrFail();
        $folderPath = storage_path('app/public/qrcodes/');
        $qrCodePath = $folderPath . $data->kode_sn . '.png';
        $folderPath = storage_path('app/public/qrcodes/');
        $qrCodePath = $folderPath . $data->kode_sn . '.png';
        return view('pages.report.show', compact('data', 'qrCodePath'));
    }

    public function export(Request $request)
    {
        // Mengambil data dari query params
        $kategori = $request->query('kategori');
        $kondisi = $request->query('kondisi');
        $pj = $request->query('pj');
        $periode = $request->query('periode');
        $sn = $request->query('sn');

        // Cek sn jika ada maka jadikan array jika tidak jadikan array kosong
        if ($sn) {
            $snArray = explode(',', $sn);
        } else {
            $snArray = [];
        }

        // memasukan variabel kedalam suatu array
        $params = [$kategori, $kondisi, $pj, $snArray, $periode];
        // dd($params);
        return Excel::download(new ReportExport($params), 'data.xlsx');
    }
}
