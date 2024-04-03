<?php

namespace App\Exports\FixedAsset;

use Maatwebsite\Excel\Concerns\WithTitle;
use App\Models\DataMaster\SpecialLocation;
use App\Models\DataMaster\Unit;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UnitSheet implements FromCollection, ShouldAutoSize, WithHeadings, WithTitle, WithStyles, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $unit = Unit::all();
        return $unit;
    }

    public function title(): string
    {
        return 'Satuan';
    }

    public function map($data): array
    {
        return [
            $data->id,
            $data->nama,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Satuan',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }
}
