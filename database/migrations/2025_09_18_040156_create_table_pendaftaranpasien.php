<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration: Membuat tabel pendaftaran_pasiens
     */
    public function up(): void
    {
        Schema::create('pendaftaran_pasiens', function (Blueprint $table) {
            $table->id();

            // Data utama pasien
            $table->string('nama_pasien');
            $table->integer('umur');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']); // lebih aman pakai enum

            // Tujuan pemeriksaan
            $table->string('poli_tujuan');
            $table->string('dokter_tujuan');

            // Tanggal daftar
            $table->date('tanggal_daftar');

            // Otomatis tambah kolom created_at dan updated_at
            $table->timestamps();
        });
    }

    /**
     * Membatalkan migration (rollback)
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_pasiens');
    }
};
