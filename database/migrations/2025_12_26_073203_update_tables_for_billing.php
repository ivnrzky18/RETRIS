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
        // 1. Perbaikan untuk tabel 'users'
        Schema::table('users', function (Blueprint $table) {
            // Kita cek dulu: Jika kolom 'kategori' belum ada, baru tambahkan
            if (!Schema::hasColumn('users', 'kategori')) {
                $table->string('kategori')->default('rumah'); 
            }
            
            // Kita cek dulu: Jika kolom 'tunggakan' belum ada, baru tambahkan
            if (!Schema::hasColumn('users', 'tunggakan')) {
                $table->decimal('tunggakan', 12, 2)->default(0);
            }
        });

        // 2. Tambahan: Menambahkan kolom 'month' ke tabel 'payments' 
        // Ini kunci agar error "Column month not found" hilang
        if (Schema::hasTable('payments')) {
            Schema::table('payments', function (Blueprint $table) {
                if (!Schema::hasColumn('payments', 'month')) {
                    $table->string('month')->nullable()->after('amount');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['kategori', 'tunggakan']);
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('month');
        });
    }
};