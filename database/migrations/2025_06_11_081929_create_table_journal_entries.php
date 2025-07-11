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
        Schema::create('journal_entries', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_code')->unique(); // Misal: JU-0001
            $table->date('date');
            $table->text('description');
            $table->foreignId('created_by')->constrained('users');
            $table->enum('type', ['Umum', 'Penyesuaian', 'Penutup']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journal_entries');
    }
};
