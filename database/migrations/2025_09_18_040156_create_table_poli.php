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
        Schema::create('polis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_poli')->unique(); // Kode poli, contoh: POLI001
            $table->string('nama_poli');           // Nama poli, contoh: Poli Jantung
            $table->text('keterangan')->nullable(); // Keterangan tambahan
            $table->string('dokter_penanggung_jawab')->nullable(); // Nama dokter
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('polis');
    }
};
