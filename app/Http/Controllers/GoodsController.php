<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class GoodsController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = [
                [
                    'id' => 1,
                    'kategori' => 'Elektronik',
                    'sub_kategori' => 'Laptop',
                    'nama' => 'Laptop',
                    'merek' => 'Laptop Acer Nitro 5',
                    'tahun_perolehan' => '2019',
                ],
            ];

            $datatablesData = collect($data)->map(function ($item) {
                return [
                    'id' => $item['id'],
                    'kategori' => $item['kategori'],
                    'sub_kategori' => $item['sub_kategori'],
                    'nama' => $item['nama'],
                    'merek' => $item['merek'],
                    'tahun_perolehan' => $item['tahun_perolehan'],
                    'action' => view('components.goodsAction', compact('item'))->render(),
                ];
            });
            return DataTables::of($datatablesData)->addIndexColumn()->make();

            // return DataTables::of($query)
            //     ->addColumn(
            //         'action',
            //         function ($user) {
            //             return view('components.usersAction', compact('user'));
            //         }
            //     )->addIndexColumn()
            //     ->make();
        }
        return view('pages.data-master.goods.index');
    }

    public function create()
    {
        return view('pages.data-master.goods.create');
    }

    public function edit()
    {
        return view('pages.data-master.goods.edit');
    }
}
