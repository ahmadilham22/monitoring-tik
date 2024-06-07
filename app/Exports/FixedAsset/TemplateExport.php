<?php

namespace App\Exports\FixedAsset;

use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TemplateExport implements ShouldAutoSize, WithHeadings, WithTitle, WithStyles, FromCollection
{
    public function title(): string
    {
        return 'Template Export';
    }

    public function collection()
    {
        // Buat data dummy dalam bentuk collection
        $dummyData = collect([
            [
                'No' => 1,
                'sub_category_id' => 1,
                'specific_location_id' => 1,
                'procurement_id' => 1,
                'unit_id' => 1,
                'user_id' => 1,
                'tahun_perolehan' => '2019',
                'kode_bmn' => 'BMN001',
                'kode_sn' => 'SN001',
                'kondisi' => 'Baik',
                'harga' => 1000000,
                'keterangan' => 'Keterangan 1',
            ],
            [
                'No' => 2,
                'sub_category_id' => 2,
                'specific_location_id' => 2,
                'procurement_id' => 2,
                'unit_id' => 2,
                'user_id' => 2,
                'tahun_perolehan' => '2019',
                'kode_bmn' => 'BMN002',
                'kode_sn' => 'SN002',
                'kondisi' => 'Rusak',
                'harga' => 2000000,
                'keterangan' => 'Keterangan 2',
            ],
            // Tambahkan data dummy lainnya sesuai kebutuhan Anda
        ]);

        return $dummyData;
    }

    public function headings(): array
    {
        return [
            'No',
            'sub_category_id',
            'specific_location_id',
            'procurement_id',
            'unit_id',
            'user_id',
            'tahun_perolehan',
            'kode_bmn',
            'kode_sn',
            'kondisi',
            'harga',
            'keterangan',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }
}
