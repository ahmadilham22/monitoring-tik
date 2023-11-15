<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FixedAssetController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = [
                [
                    'id' => 1,
                    'kategori' => 'Laptop',
                    'sub_kategori' => 'Laptop acer Nitro 5',
                    'lokasi' => 'Gedung TIK',
                    'jumlah' => '200',
                    'kondisi' => 'Baik',
                    'penanggung_jawab' => 'Admin 1',
                ],
            ];

            $datatablesData = collect($data)->map(function ($item) {
                return [
                    'id' => $item['id'],
                    'kategori' => $item['kategori'],
                    'sub_kategori' => $item['sub_kategori'],
                    'lokasi' => $item['lokasi'],
                    'jumlah' => $item['jumlah'],
                    'kondisi' => $item['kondisi'],
                    'penanggung_jawab' => $item['penanggung_jawab'],
                    'action' => view('components.fixedAssetAction', compact('item'))->render(),
                ];
            });
            return DataTables::of($datatablesData)->addIndexColumn()->make();
        }

        return view('pages.data-asset.fixed-assets.index');
    }

    public function create()
    {
        return view('pages.data-asset.fixed-assets.create');
    }
    public function edit()
    {
        return view('pages.data-asset.fixed-assets.edit');
    }

    public function show()
    {
        return view('pages.data-asset.fixed-assets.show');
    }
}