<?php

namespace App\Repositories\DataAssets;

use App\Models\DataAsset\FixedAsset;

class FixedAssetRepository
{
    public $model;
    private $fixedAssetData;

    public function __construct()
    {
        $this->model = app(FixedAsset::class);
        $this->fixedAssetData = $this;
    }

    public function model()
    {
        return $this->model;
    }

    public function getDataTable()
    {
        $data = $this->model->with(['category', 'subcategory', 'location', 'specificLocation', 'division', 'procurement'])
            ->select(
                'fixed_assets.id',
                'kode_sn',
                'categories.nama_kategori as category_name',
                'sub_categories.nama_sub_kategori as sub_category_name',
                'locations.lokasi_umum',
                'jumlah_barang',
                'kondisi',
                'penanggung_jawab'
            )
            ->join('categories', 'fixed_assets.category_id', '=', 'categories.id')
            ->join('sub_categories', 'fixed_assets.sub_category_id', '=', 'sub_categories.id')
            ->join('locations', 'fixed_assets.location_id', '=', 'locations.id')
            ->get();

        return $data;
    }
}