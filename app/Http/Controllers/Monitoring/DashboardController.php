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
        $data = FixedAsset::join('categories', 'fixed_assets.category_id', '=', 'categories.id')
            ->select(
                'categories.nama_kategori as category_name',
                DB::raw('count(*) as total_count')
            )
            ->groupBy('categories.nama_kategori')
            ->get();

        $datas = FixedAsset::with(['category', 'subcategory', 'location', 'specificLocation', 'division', 'procurement'])
            ->join('categories', 'fixed_assets.category_id', '=', 'categories.id')
            ->select(
                'categories.nama_kategori as category_name',
                'fixed_assets.kondisi as kondisi'
            )
            ->groupBy('categories.nama_kategori', 'fixed_assets.kondisi')
            ->get();

        return view('pages.dashboard.index', compact('data'));
    }
}
