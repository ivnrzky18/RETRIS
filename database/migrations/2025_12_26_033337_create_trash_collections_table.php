<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('trash_collections', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users'); // Warga pemilik rumah
        $table->foreignId('officer_id')->constrained('users'); // Petugas lapangan
        $table->string('status')->default('Sudah Diangkut');
        $table->timestamp('collected_at'); // Jam dan tanggal angkut
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trash_collections');
    }
};
