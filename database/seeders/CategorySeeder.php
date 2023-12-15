<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\DataMaster\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kode_kategori' => 'L123',
                'nama_kategori' => 'Laptop',
            ], [
                'kode_kategori' => 'P123',
                'nama_kategori' => 'Printer',
            ],
            [
                'kode_kategori' => 'A123',
                'nama_kategori' => 'Ac',
            ],
            [
                'kode_kategori' => 'C123',
                'nama_kategori' => 'CCTV',
            ],
            [
                'kode_kategori' => 'K123',
                'nama_kategori' => 'Keyboard',
            ],
            [
                'kode_kategori' => 'M123',
                'nama_kategori' => 'Mouse',
            ],
            [
                'kode_kategori' => 'C234',
                'nama_kategori' => 'Camera',
            ],
            [
                'kode_kategori' => 'P234',
                'nama_kategori' => 'Proyektor',
            ],
            [
                'kode_kategori' => 'A234',
                'nama_kategori' => 'All In One',
            ],
        ];

        foreach ($data as  $value) {
            Category::insert([
                'kode_kategori' => $value['kode_kategori'],
                'nama_kategori' => $value['nama_kategori'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        };
    }
}
