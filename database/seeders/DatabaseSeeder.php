<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(DivisionSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(SubCategorySeeder::class);
        $this->call(LocationSeeder::class);
        $this->call(SubLocationSeeder::class);
        $this->call(ProcurementSeeder::class);
        $this->call(UnitSeeder::class);
        $this->call(UserSeeder::class);
    }
}
