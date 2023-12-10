<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\DataMaster\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kode_lokasi' => 'TIK123',
                'lokasi_umum' => 'TIK',
            ], [
                'kode_lokasi' => 'TE123',
                'lokasi_umum' => 'Teknik Elektro',
            ],
            [
                'kode_lokasi' => 'TI123',
                'lokasi_umum' => 'Teknik Informatika',
            ],
        ];

        foreach ($data as  $value) {
            Location::insert([
                'kode_lokasi' => $value['kode_lokasi'],
                'lokasi_umum' => $value['lokasi_umum'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        };
    }
}
