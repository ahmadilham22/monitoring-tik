<?php

namespace App\Exports\Report;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReportExport implements FromCollection, WithMapping, WithHeadings, WithStyles, ShouldAutoSize
{
    // use Exportable;
    protected $params;

    public function __construct($params)
    {
        $this->params = $params;
    }

    public function collection()
    {
        $query = DB::table('fixed_assets AS fa')
            ->join('sub_categories AS sc', 'fa.sub_category_id', '=', 'sc.id')
            ->join('categories AS c', 'c.id', '=', 'sc.categories_id')
            ->join('specific_locations AS sl', 'fa.specific_location_id', '=', 'sl.id')
            ->join('locations AS l', 'l.id', '=', 'sl.location_id')
            ->join('users AS u', 'fa.user_id', '=', 'u.id')
            ->select('fa.sub_category_id', 'sc.nama_sub_kategori', 'sc.categories_id', 'fa.kondisi', 'fa.kode_bmn', 'fa.kode_sn', 'fa.tahun_perolehan', 'fa.keterangan', 'fa.deleted_at', 'c.nama_kategori', 'l.lokasi_umum', 'sl.lokasi_khusus', 'u.nama');

        if ($this->params[0] !== null && $this->params[0] !== '') {
            $query->where('sc.categories_id', $this->params[0]);
        }
        if ($this->params[1] !== null && $this->params[1] !== '') {
            $query->where('fa.kondisi', $this->params[1]);
        }
        if ($this->params[2] !== null && $this->params[2] !== '') {
            $query->where('fa.user_id', $this->params[2]);
        }
        if ($this->params[3] !== null && !empty($this->params[3])) {
            $query->whereIn('fa.kode_sn', $this->params[3]);
        }
        if ($this->params[4] !== null && $this->params[4] !== '') {
            $query->where('fa.tahun_perolehan', $this->params[4]);
        }
        if ($this->params[0] === null && $this->params[1] === null && $this->params[2] === null && $this->params[3] === null && $this->params[4] === null) {
            $query->whereNull('fa.deleted_at');
        }

        $result = $query->get();
        return $result;
    }

    public function map($fixedAsset): array
    {
        return [
            $fixedAsset->kode_bmn,
            $fixedAsset->kode_sn,
            $fixedAsset->nama_kategori,
            $fixedAsset->nama_sub_kategori,
            $fixedAsset->lokasi_umum,
            $fixedAsset->lokasi_khusus,
            $fixedAsset->tahun_perolehan,
            $fixedAsset->kondisi,
            $fixedAsset->nama,
            $fixedAsset->keterangan,
        ];
    }

    public function headings(): array
    {
        return [
            'Kode BMN',
            'Kode SN',
            'Nama Kategori',
            'Nama Sub Kategori',
            'Lokasi',
            'Sub Lokasi',
            'Tahun Perolehan',
            'Kondisi',
            'Penanggung Jawab',
            'Keterangan',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }
}
