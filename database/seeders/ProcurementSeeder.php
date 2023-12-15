<?php

namespace Database\Seeders;

use App\Models\DataMaster\Procurement;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProcurementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'mitra' => 'XL',
                'jenis_pengadaan' => 'Mandiri',
            ], [
                'mitra' => 'Telkomsel',
                'jenis_pengadaan' => 'Hibah',
            ],
            [
                'mitra' => 'KOMINFO',
                'jenis_pengadaan' => 'Hibah',
            ],
        ];

        foreach ($data as  $value) {
            Procurement::insert([
                'mitra' => $value['mitra'],
                'jenis_pengadaan' => $value['jenis_pengadaan'],
                'tahun_pengadaan' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        };
    }
}
