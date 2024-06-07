<?php

namespace App\Exports\FixedAsset;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MultipleSheetTemplateExport implements WithMultipleSheets, Responsable
{
    use Exportable;

    private $fileName = "template.xlsx";
    public function sheets(): array
    {
        return [
            'Template Export' => new TemplateExport(),
            'Sub Kategori' => new SubcategorySheet(),
            'Sub Lokasi' => new SublocationSheet(),
            'Satuan' => new UnitSheet(),
            'Mitra' => new ProcurementSheet(),
            'User' => new UserSheet(),
        ];
    }
}
