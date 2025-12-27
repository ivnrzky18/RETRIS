<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Membuat Akun ADMIN
        User::create([
            'name' => 'Admin Retris',
            'email' => 'admin@retris.com',
            'password' => Hash::make('password'), // Password: password
            'role' => 'admin',
        ]);

        // 2. Membuat Akun PETUGAS
        User::create([
            'name' => 'Petugas Lapangan',
            'email' => 'petugas@retris.com',
            'password' => Hash::make('password'),
            'role' => 'petugas',
        ]);

        // 3. Membuat Akun WARGA (Contoh 2 Rumah)
        User::create([
            'name' => 'Audy Oktavia',
            'email' => 'audy@warga.com',
            'password' => Hash::make('password'),
            'role' => 'warga',
            'blok' => 'A',
            'no_rumah' => '12',
            'alamat' => 'Blok A No. 12',
            'saldo' => 50000,
        ]);

        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@warga.com',
            'password' => Hash::make('password'),
            'role' => 'warga',
            'blok' => 'B',
            'no_rumah' => '05',
            'alamat' => 'Blok B No. 05',
            'saldo' => 10000,
        ]);
    }
}