<?php

namespace App\Exports\FixedAsset;

use App\Models\DataMaster\SpecialLocation;
use App\Models\DataMaster\SubCategory;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SubLocationSheet implements FromCollection, ShouldAutoSize, WithHeadings, WithTitle, WithStyles, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $subLocation = SpecialLocation::with(['location'])->first();
        return $subLocation;
    }

    public function title(): string
    {
        return 'Sub Lokasi';
    }

    public function map($data): array
    {
        return [
            $data->id,
            $data->location->lokasi_umum,
            $data->kode_lokasi,
            $data->lokasi_khusus,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Lokasi',
            'Kode Sub Lokasi',
            'Sub Lokasi',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }
}
