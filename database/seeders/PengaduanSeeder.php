<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Pengaduan;
use App\Models\Siswa;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PengaduanSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $kategoriIds = Kategori::pluck('id')->toArray();
        if (empty($kategoriIds)) {
            $kategori = Kategori::create(['nama_kategori' => 'Lainnya']);
            $kategoriIds = [$kategori->id];
        }

        $siswaNis = Siswa::pluck('nis')->toArray();
        if (empty($siswaNis)) {
            // Jika belum ada siswa, hentikan agar SiswaSeeder dipanggil terlebih dahulu.
            return;
        }

        $judulContoh = [
            'Kebocoran atap di ruang kelas',
            'AC tidak berfungsi di lab komputer',
            'Kondisi toilet kotor dan tidak terawat',
            'Kerusakan meja dan kursi di ruang belajar',
            'Sampah menumpuk di halaman sekolah',
            'Perundungan (bullying) di kelas',
            'Makanan kantin kurang layak',
            'Akses jalan menuju sekolah rusak',
            'Wifi sekolah tidak stabil',
            'Gangguan kebersihan di area kantin',
        ];

        $isiContoh = [
            'Terdapat kebocoran pada atap ruang kelas yang menyebabkan lantai basah saat hujan.',
            'AC di laboratorium komputer tidak dingin sehingga aktivitas pembelajaran terganggu.',
            'Toilet sering kotor dan tidak tersedia sabun cuci tangan.',
            'Beberapa meja dan kursi rusak sehingga mengganggu proses belajar mengajar.',
            'Sampah menumpuk di area depan sekolah dan belum diangkut selama beberapa hari.',
            'Telah terjadi kasus perundungan di kelas yang perlu ditindaklanjuti oleh pihak sekolah.',
            'Terdapat keluhan makanan di kantin yang tidak memenuhi standar kebersihan.',
            'Jalan masuk sekolah berlubang dan membahayakan pengguna kendaraan.',
            'Koneksi internet di sekolah sering terputus sehingga pembelajaran daring terganggu.',
            'Area kantin tidak terjaga kebersihannya sehingga menimbulkan bau tidak sedap.',
        ];

        for ($i = 0; $i < 20; $i++) {
            $isAnonymous = $faker->boolean(20);

            Pengaduan::create([
                'kategori_id' => $faker->randomElement($kategoriIds),
                'siswa_nis' => $isAnonymous ? null : $faker->randomElement($siswaNis),
                'judul_laporan' => $faker->randomElement($judulContoh),
                'isi_laporan' => $faker->randomElement($isiContoh),
                'foto' => 'no-image.png',
                'status' => $faker->randomElement(['pending', 'proses', 'selesai']),
                'is_anonymous' => $isAnonymous,
            ]);
        }
    }
}
