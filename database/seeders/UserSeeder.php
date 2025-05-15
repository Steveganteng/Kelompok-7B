<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan data admin
        User::create([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'), // Password yang di-hash
            'role' => 'superadmin',
        ]);

        // Menambahkan data dokter
        User::create([
            'username' => 'dokter',
            'email' => 'dokter@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dokter',
        ]);

        // Menambahkan data apoteker
        User::create([
            'username' => 'apoteker',
            'email' => 'apoteker@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'apoteker',
        ]);
    }
}
