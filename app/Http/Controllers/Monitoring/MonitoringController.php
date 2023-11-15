<?php

namespace App\Http\Controllers\Monitoring;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class MonitoringController extends Controller
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
                    'action' => view('components.actions.monitoringAction', compact('item'))->render(),
                ];
            });
            return DataTables::of($datatablesData)->addIndexColumn()->make();
        }

        return view('pages.monitoring.index');
    }

    public function create()
    {
        return view('pages.monitoring.create');
    }
    public function edit()
    {
        return view('pages.monitoring.edit');
    }
    public function show()
    {
        return view('pages.monitoring.show');
    }
}
