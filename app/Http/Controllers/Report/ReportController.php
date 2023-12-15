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
            $data = FixedAsset::with(['subcategory.category', 'specificlocation.location', 'user', 'procurement'])->get();

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
        // dd($subcategories);
        $users = DB::table('users')->select('id', 'nama')->where('role', 'admin')->whereNotNull('division_id')->get();


        $conditions = array_combine($kondisi, $kondisi);
        // return $users;

        return view('pages.report.index', compact('conditions', 'users', 'subcategories'));
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
        $data = FixedAsset::with(['subcategory.category', 'specificlocation.location', 'user', 'procurement', 'unit'])->findOrFail($id);

        $folderPath = storage_path('app/public/qrcodes/');
        $qrCodePath = $folderPath . $data->kode_sn . '.png';
        if (file_exists($qrCodePath)) {
            return view('pages.report.show', compact('data', 'qrCodePath'));
        } else {
            return view('pages.data-asset.fixed-assets.show_not_found', compact('data'));
        }
    }

    public function export(Request $request)
    {
        // $params = [
        //     $_GET['kategori'] ?? null,
        //     $_GET['kondisi'] ?? null,
        //     $_GET['pj'] ?? null,
        //     $_GET['id'] ?? null
        // ];
        // dd($params);
        $kategori = $request->query('kategori');
        $kondisi = $request->query('kondisi');
        $pj = $request->query('pj');
        // $id = $request->query('checkedIds');
        // Lakukan apa pun yang Anda perlukan dengan nilai-nilai ini
        $params = [$kategori, $kondisi, $pj];
        // dd($params);
        return Excel::download(new ReportExport($params), 'data.xlsx');
    }
}
