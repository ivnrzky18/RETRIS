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
        Schema::create('cash_banks', function (Blueprint $table) {
            $table->id();
            $table->enum('tipe_transaksi', ['Masuk', 'Keluar']);
            $table->enum('sumber', ['Kas', 'Bank']);
            $table->date('tanggal');
            $table->string('deskripsi');
            $table->decimal('jumlah', 20, 2);
            $table->foreignId('account_id')->constrained('accounts');
            $table->foreignId('journal_entry_id')->nullable()->constrained('journal_entries');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_banks');
    }
};
