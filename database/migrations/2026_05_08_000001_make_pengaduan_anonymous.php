<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Lepaskan foreign key agar kolom bisa dibuat nullable.
        Schema::table('pengaduan', function (Blueprint $table): void {
            $table->dropForeign(['siswa_nis']);
        });

        // Buat siswa_nis nullable (untuk pengaduan anonim).
        DB::statement('ALTER TABLE pengaduan MODIFY siswa_nis INTEGER NULL');

        // Tandai apakah laporan anonim atau tidak.
        Schema::table('pengaduan', function (Blueprint $table): void {
            $table->boolean('is_anonymous')->default(false)->after('siswa_nis');
        });
    }

    public function down(): void
    {
        Schema::table('pengaduan', function (Blueprint $table): void {
            $table->dropColumn('is_anonymous');
        });

        // Kembalikan siswa_nis menjadi NOT NULL.
        DB::statement('ALTER TABLE pengaduan MODIFY siswa_nis INTEGER NOT NULL');

        Schema::table('pengaduan', function (Blueprint $table): void {
            $table->foreign('siswa_nis')->references('nis')->on('siswa')->cascadeOnDelete();
        });
    }
};
