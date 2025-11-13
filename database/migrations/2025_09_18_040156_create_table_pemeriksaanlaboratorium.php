<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemeriksaanlaboratorium', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pasien');    // Nama pasien
            $table->string('jenis_tes');      // Jenis pemeriksaan laboratorium
            $table->string('hasil');          // Hasil pemeriksaan
            $table->date('tanggal_tes');      // Tanggal pemeriksaan dilakukan
            $table->timestamps();             // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemeriksaanlaboratorium');
    }
};
