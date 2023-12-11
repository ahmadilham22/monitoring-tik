<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\DataMaster\SpecialLocation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'location_id' => '1',
                'kode_lokasi' => 'TIK123.01',
                'lokasi_khusus' => 'Ruang 1',
            ], [
                'location_id' => '2',
                'kode_lokasi' => 'TE123.01',
                'lokasi_khusus' => 'Ruang Admin',
            ],
            [
                'location_id' => '3',
                'kode_lokasi' => 'TI123.01',
                'lokasi_khusus' => 'Ruang Dosen',
            ],
        ];

        foreach ($data as  $value) {
            SpecialLocation::insert([
                'location_id' => $value['location_id'],
                'kode_lokasi' => $value['kode_lokasi'],
                'lokasi_khusus' => $value['lokasi_khusus'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        };
    }
}