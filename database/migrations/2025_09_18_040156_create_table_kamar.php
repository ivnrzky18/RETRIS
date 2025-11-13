<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // PENTING: Menggunakan nama tabel 'kamar' (singular, snake_case)
        Schema::create('kamar', function (Blueprint $table) {
            $table->id();
            
            // Kolom untuk Kamar
            $table->string('nomor_kamar', 10)->unique(); // Nomor kamar, harus unik

            // --- PERUBAHAN: Tambahkan kolom tipe_kamar dengan enum ---
            $table->enum('tipe_kamar', ['ac', 'non ac', 'lengkap']); // Tipe kamar baru: ac, non ac, atau lengkap
            // --------------------------------------------------------

            $table->decimal('harga', 10, 0); // Harga sewa bulanan (misalnya, 10 digit total, 0 di belakang koma)
            $table->enum('status', ['Tersedia', 'Terisi', 'Dalam Perbaikan']); // Status kamar
            $table->text('deskripsi')->nullable(); // Deskripsi atau fasilitas kamar
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamar');
    }
};