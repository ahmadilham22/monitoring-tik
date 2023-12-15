<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\DataMaster\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'categories_id' => '1',
                'kode_sub_kategori' => 'L123.01',
                'nama_sub_kategori' => 'Acer Nitro 5',
            ], [
                'categories_id' => '2',
                'kode_sub_kategori' => 'P123.01',
                'nama_sub_kategori' => 'Epson P403',
            ],
            [
                'categories_id' => '3',
                'kode_sub_kategori' => 'A123.01',
                'nama_sub_kategori' => 'Daikin 1.5 PK',
            ],
            [
                'categories_id' => '4',
                'kode_sub_kategori' => 'C123.01',
                'nama_sub_kategori' => 'Mobo Sportlight',
            ],
            [
                'categories_id' => '5',
                'kode_sub_kategori' => 'K123.01',
                'nama_sub_kategori' => 'Red Dragon K12',
            ],
            [
                'categories_id' => '6',
                'kode_sub_kategori' => 'M123.01',
                'nama_sub_kategori' => 'Logitech G20',
            ],
            [
                'categories_id' => '7',
                'kode_sub_kategori' => 'C234.01',
                'nama_sub_kategori' => 'Fujifilm Xa3',
            ],
            [
                'categories_id' => '8',
                'kode_sub_kategori' => 'P234.01',
                'nama_sub_kategori' => 'Epson P20',
            ],
            [
                'categories_id' => '9',
                'kode_sub_kategori' => 'A234.01',
                'nama_sub_kategori' => 'Axios A99',
            ],
        ];

        foreach ($data as  $value) {
            SubCategory::insert([
                'categories_id' => $value['categories_id'],
                'kode_sub_kategori' => $value['kode_sub_kategori'],
                'nama_sub_kategori' => $value['nama_sub_kategori'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        };
    }
}
