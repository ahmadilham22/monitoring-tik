<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\DataMaster\Division;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kode_divisi' => 'SDIA',
                'nama_divisi' => 'SUMBEDAYA INFORMASI DAN AKADEMIK',
            ], [
                'kode_divisi' => 'LST',
                'nama_divisi' => 'LAYANAN SISTEM DAN TEKNOLOGI',
            ],
            [
                'kode_divisi' => 'TBDA',
                'nama_divisi' => 'TEKNOLOGI BIG DATA DAN ANALISIS',
            ],
            [
                'kode_divisi' => 'PIA',
                'nama_divisi' => 'PENGEMBANGAN DAN INTEGRASI APLIKASI',
            ],
            [
                'kode_divisi' => 'PDK',
                'nama_divisi' => 'PUSAT DATA DAN KEAMANAN',
            ],
            [
                'kode_divisi' => 'ISJ',
                'nama_divisi' => 'INFRASTRUKTUR JARINGAN',
            ],
            [
                'kode_divisi' => 'PIS',
                'nama_divisi' => 'PENGELOLAAN INFORMASI SUMBERDAYA',
            ],
        ];

        foreach ($data as  $value) {
            Division::insert([
                'kode_divisi' => $value['kode_divisi'],
                'nama_divisi' => $value['nama_divisi'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        };
    }
}
