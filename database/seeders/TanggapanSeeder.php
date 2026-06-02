<?php

namespace Database\Seeders;

use App\Models\Pengaduan;
use App\Models\Petugas;
use App\Models\Tanggapan;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TanggapanSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $petugasIds = Petugas::pluck('id')->toArray();
        if (empty($petugasIds)) {
            Petugas::create([
                'username' => 'petugas1',
                'nama_petugas' => 'Petugas 1',
                'level' => 'petugas',
                'password' => bcrypt('petugas123'),
            ]);
            $petugasIds = Petugas::pluck('id')->toArray();
        }

        $pengaduanIds = Pengaduan::pluck('id')->toArray();
        if (empty($pengaduanIds)) {
            return;
        }

        $contohTanggapan = [
            'Terima kasih atas laporan Anda. Kami akan menindaklanjuti secepatnya.',
            'Laporan diterima, petugas sedang ditugaskan untuk melakukan pengecekan.',
            'Masalah sedang dalam proses perbaikan. Mohon bersabar.',
            'Tindakan telah dilakukan. Mohon konfirmasi jika masalah telah teratasi.',
            'Mohon maaf atas ketidaknyamanan, kami akan perbaiki secepat mungkin.',
        ];

        foreach ($pengaduanIds as $pengaduanId) {
            $count = rand(0, 2);
            for ($i = 0; $i < $count; $i++) {
                Tanggapan::create([
                    'pengaduan_id' => $pengaduanId,
                    'petugas_id' => $faker->randomElement($petugasIds),
                    'isi_tanggapan' => $faker->randomElement($contohTanggapan),
                ]);
            }
        }
    }
}
