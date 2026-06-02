<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $grades = ['X', 'XI', 'XII'];
        $majors = ['RPL', 'TSM', 'TKJ', 'TEI', 'ANM'];

        $nisBase = [
            'X' => 1000,
            'XI' => 2000,
            'XII' => 3000,
        ];

        foreach ($grades as $grade) {
            $base = $nisBase[$grade];
            $counter = 1;
            foreach ($majors as $major) {
                for ($i = 0; $i < 3; $i++) {
                    $nis = $base + $counter;

                    Siswa::updateOrCreate(
                        ['nis' => $nis],
                        [
                            'username' => 's' . $nis,
                            'nama_siswa' => $faker->name(),
                            'kelas' => $grade . ' ' . $major,
                            'no_hp' => 81200000000 + $nis,
                            'password' => bcrypt('password'),
                        ]
                    );

                    $counter++;
                }
            }
        }
    }
}
