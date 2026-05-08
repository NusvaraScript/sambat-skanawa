<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = [
            'Fasilitas & Sarana Prasarana',
            'Kebersihan & Sanitasi',
            'Keamanan Sekolah',
            'Perundungan (Bullying) & Kekerasan',
            'Pelecehan & Perlindungan Siswa',
            'Kedisiplinan & Tata Tertib',
            'Kegiatan Belajar Mengajar',
            'Penilaian / Ujian / Tugas',
            'Guru & Staf (Layanan / Perilaku)',
            'Administrasi & Surat-Menyurat',
            'Bimbingan Konseling (BK)',
            'Kantin & Makanan',
            'Kegiatan OSIS / Ekstrakurikuler',
            'Transportasi / Parkir',
            'Layanan Digital / Sistem (Website, WiFi, Lab)',
            'Lainnya',
        ];

        foreach ($kategoris as $nama) {
            Kategori::updateOrCreate(
                ['nama_kategori' => $nama],
                ['nama_kategori' => $nama],
            );
        }
    }
}

