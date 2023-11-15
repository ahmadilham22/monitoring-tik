<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class ReportController extends Controller
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
                    'penanggung_jawab' => $item['penanggung_jawab'],
                    'action' => view('components.report.reposrtAction', compact('item'))->render(),
                ];
            });
            return DataTables::of($datatablesData)->addIndexColumn()->make();
        }

        return view('pages.report.index');
    }

    public function create()
    {
        return view('pages.report.create');
    }
    public function edit()
    {
    }
    public function show()
    {
    }
}
