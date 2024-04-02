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
            [
                'nama' => 'Hadianto Cahyadi, S.Kom',
                'email' => 'Hadianto Cahyadi, S.Kom',
                'password' => Hash::make('123456789'),
                'role' => 'super_admin',
            ],
            [
                'nama' => 'Hendri Susanto, S.T.',
                'email' => 'Hendri Susanto, S.T.',
                'password' => Hash::make('123456789'),
                'role' => 'super_admin',
            ],
            [
                'nama' => 'Supriyanto',
                'email' => 'Supriyanto@gmail.com',
                'password' => Hash::make('123456789'),
                'role' => 'super_admin',
            ],
            [
                'nama' => 'Kholik Farijal, S.Kom',
                'email' => 'Kholikfarijal@gmail.com',
                'password' => Hash::make('123456789'),
                'role' => 'super_admin',
            ],
            [
                'nama' => 'Pompy Pratama Putra, S.E.,M.M',
                'email' => 'Pompypratamaputra@gmail.com',
                'password' => Hash::make('123456789'),
                'role' => 'super_admin',
            ],
            [
                'nama' => 'Nokimala',
                'email' => 'Nokimala@gmail.com',
                'password' => Hash::make('123456789'),
                'role' => 'super_admin',
            ],
            [
                'nama' => 'Rahmadona',
                'email' => 'Rahmadona@gmail.com',
                'password' => Hash::make('123456789'),
                'role' => 'super_admin',
            ],
            [
                'nama' => 'Harno, S.I.,Kom',
                'email' => 'Harno@gmail.com',
                'password' => Hash::make('123456789'),
                'role' => 'super_admin',
            ],
            [
                'nama' => 'Kasdi Pratama, A.,Md.',
                'email' => 'Kasdipratama@gmail.com',
                'password' => Hash::make('123456789'),
                'role' => 'super_admin',
            ],
            [
                'nama' => 'Yeni Farida, A.M.',
                'email' => 'Yenifarida@gmail.com',
                'password' => Hash::make('123456789'),
                'role' => 'super_admin',
            ],
            [
                'nama' => 'Okta Reza, S.Kom',
                'email' => 'Oktareza@gmail.com',
                'password' => Hash::make('123456789'),
                'role' => 'super_admin',
            ],
            [
                'nama' => 'Aditya Dwi Abrianto, S.E.',
                'email' => 'Adityadwiabrianto@gmail.com',
                'password' => Hash::make('123456789'),
                'role' => 'super_admin',
            ],
            [
                'nama' => 'Boby Mardani, S.Kom., S.E.',
                'email' => 'Bobymardani@gmail.com',
                'password' => Hash::make('123456789'),
                'role' => 'super_admin',
            ],
            [
                'nama' => 'Wahozin',
                'email' => 'Wahozin@gmail.com',
                'password' => Hash::make('123456789'),
                'role' => 'super_admin',
            ],
            [
                'nama' => 'Ikhwan Catur Nugroho, S.Pi.',
                'email' => 'Ikhwancaturnugroho@gmail.com',
                'password' => Hash::make('123456789'),
                'role' => 'super_admin',
            ],
            [
                'nama' => 'Nyoman Herman Ardike, S.T.',
                'email' => 'Nyomanhermanardike@gmail.com',
                'password' => Hash::make('123456789'),
                'role' => 'super_admin',
            ],
            [
                'nama' => 'Aprily Ayu Anbar, S.T.',
                'email' => 'Aprilyayuanbar@gmail.com',
                'password' => Hash::make('123456789'),
                'role' => 'super_admin',
            ],
            [
                'nama' => 'Zuliana Nurfadillah, S.Kom',
                'email' => 'Zuliananurfadillah@gmail.com',
                'password' => Hash::make('123456789'),
                'role' => 'super_admin',
            ],
            [
                'nama' => 'Mizar Zulmi Ramadhan, S.Kom',
                'email' => 'Mizarzulmiramadhan@gmail.com',
                'password' => Hash::make('123456789'),
                'role' => 'super_admin',
            ],
            [
                'nama' => 'Alifan Akbar Ikhsansah',
                'email' => 'Alifanakbarikhsansah@gmail.com',
                'password' => Hash::make('123456789'),
                'role' => 'super_admin',
            ],
            [
                'nama' => 'Gontor Ganta Nama',
                'email' => 'Gontorgantanama@gmail.com',
                'password' => Hash::make('123456789'),
                'role' => 'admin',
            ],
            [
                'nama' => 'Rahmad Junaidi',
                'email' => 'Rahmadjunaidi@gmail.com',
                'password' => Hash::make('123456789'),
                'role' => 'admin',
            ],
            [
                'nama' => 'Muhammad Ikhsan',
                'email' => 'Muhammadikhsan@gmail.com',
                'password' => Hash::make('123456789'),
                'role' => 'super_admin',
            ],
            [
                'nama' => 'Aditya Anggi',
                'email' => 'AdityaAnggi@gmail.com',
                'password' => Hash::make('123456789'),
                'role' => 'admin',
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
