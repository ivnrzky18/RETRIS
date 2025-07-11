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
        Schema::create('accounting_periods', function (Blueprint $table) {
            $table->id();
             $table->string('nama_periode'); // contoh: Januari 2025
            $table->date('tanggal_awal');
            $table->date('tanggal_akhir');
            $table->enum('status', ['Dibuka', 'Ditutup'])->default('Dibuka');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounting_periods');
    }
};
