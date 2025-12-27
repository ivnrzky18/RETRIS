<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_create_transactions_table.php
public function up()
{
    Schema::create('transactions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->enum('type', ['topup', 'payment']); // topup = masuk, payment = bayar iuran
        $table->integer('amount'); // Jumlah uang
        $table->string('month')->nullable(); // Untuk mencatat tagihan bulan apa (contoh: "December 2025")
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
