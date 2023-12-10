<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\DataMaster\Unit;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Buah',
            ], [
                'nama' => 'Lembar',
            ],
            [
                'nama' => 'Unit',
            ],
        ];

        foreach ($data as  $value) {
            Unit::insert([
                'nama' => $value['nama'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        };
    }
}
