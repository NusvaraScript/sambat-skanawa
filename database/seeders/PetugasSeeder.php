<?php

namespace Database\Seeders;

use App\Models\Petugas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Akun admin utama
        Petugas::updateOrCreate(
            ['username' => 'admin'],
            [
                'nama_petugas' => 'Administrator',
                'level' => 'admin',
                'password' => Hash::make('admin123'),
            ],
        );

        // Akun petugas default (non-admin)
        Petugas::updateOrCreate(
            ['username' => 'petugas'],
            [
                'nama_petugas' => 'Petugas Default',
                'level' => 'petugas',
                'password' => Hash::make('petugas123'),
            ],
        );
    }
}
