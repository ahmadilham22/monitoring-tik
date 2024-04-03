<?php

namespace App\Exports\FixedAsset;

use App\Models\DataMaster\SubCategory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SubcategorySheet implements FromCollection, ShouldAutoSize, WithHeadings, WithTitle, WithStyles, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $SubCategory = SubCategory::with('category')->first();
        return $SubCategory;
    }

    public function title(): string
    {
        return 'Sub Kategori';
    }

    public function map($data): array
    {
        return [
            $data->id,
            $data->category->kode_kategori,
            $data->category->nama_kategori,
            $data->kode_sub_kategori,
            $data->nama_sub_kategori,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Kode Kategori',
            'Kategori',
            'Kode Sub Kategori',
            'Sub Kategori',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }
}
