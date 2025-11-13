<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rekammedis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pasien');       // Nama pasien
            $table->string('diagnosa');          // Diagnosa pasien
            $table->string('tindakan');          // Tindakan medis yang dilakukan
            $table->date('tanggal_rekam');       // Tanggal rekam medis dibuat
            $table->timestamps();                // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rekammedis');
    }
};
