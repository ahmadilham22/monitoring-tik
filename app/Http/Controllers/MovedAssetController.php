<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MovedAssetController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = [
                [
                    'id' => 1,
                    'nama' => 'TIKLAPTOP1022',
                    'kategori' => 'LAPTOP ACER NITRO 5',
                    'jumlah_barang' => 'LAPTOP',
                    'lokasi' => 'LAPTOP',
                    'kondisi' => 'LAPTOP',
                    'penanggung_jawab' => 'LAPTOP',
                ],
            ];

            $datatablesData = collect($data)->map(function ($item) {
                return [
                    'id' => $item['id'],
                    'nama' => $item['nama'],
                    'kategori' => $item['kategori'],
                    'jumlah_barang' => $item['jumlah_barang'],
                    'lokasi' => $item['lokasi'],
                    'kondisi' => $item['kondisi'],
                    'penanggung_jawab' => $item['penanggung_jawab'],
                    'action' => view('components.movedAssetAction', compact('item'))->render(),
                ];
            });
            return DataTables::of($datatablesData)->addIndexColumn()->make();
        }

        return view('pages.data-asset.moved-assets.index');
    }

    public function create()
    {
        return view('pages.data-asset.moved-assets.create');
    }
    public function edit()
    {
        return view('pages.data-asset.moved-assets.edit');
    }

    public function show()
    {
        return view('pages.data-asset.moved-assets.show');
    }
}
