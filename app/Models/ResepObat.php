<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResepObat extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database
     */
    protected $table = 'resep_obat'; // pastikan sesuai tabel di database

    /**
     * Kolom yang boleh diisi secara mass assignment
     */
    protected $fillable = [
        'nama_pasien',
        'nama_obat',
        'dosis',
        'jumlah',
        'aturan_pakai',
        'tanggal_resep',
    ];

    /**
     * Relasi opsional ke tabel pasien (jika ada)
     */
    public function pasien()
    {
        return $this->belongsTo(PendaftaranPasien::class, 'nama_pasien', 'nama_pasien');
    }

    /**
     * Relasi opsional ke tabel obat (jika ada)
     */
    public function obat()
    {
        return $this->belongsTo(ResepObat::class, 'nama_obat', 'nama_obat');
    }
}
