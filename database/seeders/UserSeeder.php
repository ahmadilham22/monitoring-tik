<?php

namespace Database\Seeders;

use App\Models\DataMaster\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'password' => Hash::make('superadmin'),
                'role' => 'super_admin',
            ], [
                'nama' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
                'role' => 'admin',
            ],
            [
                'nama' => 'User',
                'email' => 'user@gmail.com',
                'password' => Hash::make('user'),
                'role' => 'user',
            ],
        ];

        foreach ($data as  $value) {
            User::insert([
                'nama' => $value['nama'],
                'email' => $value['email'],
                'password' => $value['password'],
                'role' => $value['role'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        };
    }
}
