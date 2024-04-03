<?php

namespace App\Imports;

use App\Models\DataAsset\FixedAsset;
use App\Models\DataMaster\SubCategory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AssetImport implements ToModel, WithStartRow, WithValidation
{
    public function model(array $row)
    {
        Log::debug('Importing data:', $row);


        $asset = FixedAsset::create([
            'sub_category_id' => $row[1],
            'specific_location_id' => $row[2],
            'procurement_id' => $row[3],
            'unit_id' => $row[4],
            'user_id' => $row[5],
            'tahun_perolehan' => $row[6],
            'kode_bmn' => $row[7],
            'kode_sn' => $row[8],
            'kondisi' => $row[9],
            'image' => $row[10],
            'harga' => $row[11],
            'keterangan' => $row[12],
        ]);

        // dd($asset);
        $this->generateQrCode($row);
        return $asset;
    }

    public function startRow(): int
    {
        return 2;
    }

    public function rules(): array
    {
        return [
            '*.8' => ['unique']
        ];
    }

    protected function generateQrCode($row)
    {
        $assetId = $row[7];
        $url = url("/data-assets/report/show/{$assetId}");
        $qrCode = QrCode::format('png')
            ->size(500)
            ->errorCorrection('H')
            ->generate($url);

        $filename = $row[8] . '.png';
        file_put_contents(storage_path('app/public/qrcodes/') . $filename, $qrCode);

        return $filename;
    }
}
