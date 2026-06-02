<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call(KategoriSeeder::class);
        $this->call(PetugasSeeder::class);
        $this->call(SiswaSeeder::class);
        $this->call(PengaduanSeeder::class);
        $this->call(TanggapanSeeder::class);
    }
}
