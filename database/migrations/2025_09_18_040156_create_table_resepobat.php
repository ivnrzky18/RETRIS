<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('resep_obat', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pasien');           // Nama pasien
            $table->string('nama_obat');             // Nama obat
            $table->string('dosis');                 // Dosis obat
            $table->integer('jumlah');               // Jumlah obat
            $table->string('aturan_pakai');          // Aturan pakai obat
            $table->date('tanggal_resep');           // Tanggal resep dibuat
            $table->timestamps();                    // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resep_obat');
    }
};
