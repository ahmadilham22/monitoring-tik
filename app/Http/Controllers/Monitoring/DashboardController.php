<?php

namespace App\Http\Controllers\Monitoring;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\DataAsset\FixedAsset;

use function Laravel\Prompts\select;

class DashboardController extends Controller
{
    public function index()
    {
        // $data = FixedAsset::join('categories', 'fixed_assets.category_id', '=', 'categories.id')
        //     ->select(
        //         'categories.nama_kategori as category_name',
        //         DB::raw('count(*) as total_count')
        //     )
        //     ->groupBy('categories.nama_kategori')
        //     ->get();
        // $datas1 = FixedAsset::join('categories')
        //     ->select('categories.nama_kategori as category_name');
        //     ->w
        // $data1 = [];
        // foreach ($datas as $data) {
        //     $data1[] = [
        //         'nama_kategori' => $data->category_name,
        //         'jumlah' => $data->total_count
        //     ];
        // }
        // dd($datas);
        // $datas = FixedAsset::with(['category', 'subcategory', 'location', 'specificLocation', 'division', 'procurement'])
        //     ->join('categories', 'fixed_assets.category_id', '=', 'categories.id')
        //     ->select(
        //         'categories.nama_kategori as category_name',
        //         'fixed_assets.kondisi as kondisi'
        //     )
        //     ->groupBy('categories.nama_kategori', 'fixed_assets.kondisi')
        //     ->get();

        // $data1 = [
        //     'nama_kategori' => $data->first()->category_name,
        // ];

        $data = FixedAsset::with(['subcategory.category', 'specificlocation.location', 'user', 'procurement'])->get();

        // $data = DB::table('fixed_assets')
        //     ->select('fixed_assets.*', 'subcategory')
        //     ->get();

        // dd($data);

        return view('pages.dashboard.index', compact('data'));
    }
}