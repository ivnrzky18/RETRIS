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
        // Mengubah nama tabel dari 'dokter' menjadi 'penyewa'
        Schema::create('penyewa', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            // Mengubah 'spesialis' menjadi 'jenis_kelamin'
            $table->string('jenis_kelamin', 50); 
            // Menambahkan kolom 'pekerjaan'
            $table->string('pekerjaan')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('alamat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Mengubah nama tabel yang di-drop menjadi 'penyewa'
        Schema::dropIfExists('penyewa');
    }
};