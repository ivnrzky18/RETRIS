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
        // PENTING: GANTI 'pembayaran' menjadi 'pembayaran_sewa'
        Schema::create('pembayaran_sewa', function (Blueprint $table) {
            $table->id();
            // Anda harus memastikan nama kolom sesuai dengan kebutuhan Kos Manager Pro
            $table->string('nama_penyewa'); 
            $table->decimal('jumlah', 15, 2);
            $table->string('metode_pembayaran');
            $table->date('tanggal_pembayaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran_sewa');
    }
};