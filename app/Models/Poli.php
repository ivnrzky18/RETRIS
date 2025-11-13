<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'polis';

    // Kolom yang bisa diisi secara massal
    protected $fillable = [
        'kode_poli',
        'nama_poli',
        'keterangan',
        'dokter_penanggung_jawab',
    ];

    // Jika kamu ingin menambahkan relasi ke model lain, bisa seperti ini:
    // public function dokter()
    // {
    //     return $this->belongsTo(Dokter::class, 'dokter_penanggung_jawab', 'nama_dokter');
    // }
}
