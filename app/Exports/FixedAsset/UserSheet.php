<?php

namespace App\Exports\FixedAsset;

use App\Models\DataMaster\User;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UserSheet implements FromCollection, ShouldAutoSize, WithHeadings, WithTitle, WithStyles, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $user = User::all();
        return $user;
    }

    public function title(): string
    {
        return 'User';
    }

    public function map($data): array
    {
        return [
            $data->id,
            $data->nama,
            $data->email,
            $data->role,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'Email',
            'Role',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }
}
