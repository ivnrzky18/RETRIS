<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    // Nama tabel di database (Laravel secara default mencari 'kamars', 
    // namun kita definisikan eksplisit untuk kontrol)
    protected $table = 'kamar';

    // Kolom yang bisa diisi secara massal
    protected $fillable = [
        'nomor_kamar',
        'tipe_kamar', // Tambahkan field tipe_kamar di sini
        'harga',
        'status', // Contoh: Tersedia, Terisi, Dalam Perbaikan
        'deskripsi',
    ];

    // Relasi: Kamar memiliki banyak Penyewa (jika menggunakan relasi 1-to-many)
    public function penyewa()
    {
        return $this->hasMany(Penyewa::class);
    }
}