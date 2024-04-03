<?php

namespace App\Exports\FixedAsset;

use App\Models\DataMaster\Procurement;
use Maatwebsite\Excel\Concerns\WithTitle;
use App\Models\DataMaster\SpecialLocation;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProcurementSheet implements FromCollection, ShouldAutoSize, WithHeadings, WithTitle, WithStyles, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $procurement = Procurement::all();
        return $procurement;
    }

    public function title(): string
    {
        return 'Mitra';
    }

    public function map($data): array
    {
        return [
            $data->id,
            $data->mitra,
            $data->jenis_pengadaan,
            $data->tahun_pengadaan,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Mitra',
            'Jenis Pengadaan',
            'Tahun Pengadaan',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }
}
