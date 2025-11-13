<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database
     */
    protected $table = 'rekammedis'; // pastikan sesuai tabel di database

    /**
     * Kolom yang boleh diisi secara mass assignment
     */
    protected $fillable = [
        'nama_pasien',
        'diagnosa',
        'tindakan',
        'tanggal_rekam',
    ];

    /**
     * Relasi opsional ke tabel pasien (jika ada)
     */
    public function pasien()
    {
        return $this->belongsTo(PendaftaranPasien::class, 'nama_pasien', 'nama_pasien');
    }
}
