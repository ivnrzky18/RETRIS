<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanLaboratorium extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database
     */
    protected $table = 'pemeriksaanlaboratorium'; // pastikan sesuai tabel di database

    /**
     * Kolom yang boleh diisi secara mass assignment
     */
    protected $fillable = [
        'nama_pasien',
        'jenis_tes',
        'hasil',
        'tanggal_tes',
    ];

    /**
     * Relasi opsional ke tabel pasien (jika ada)
     */
    public function pasien()
    {
        return $this->belongsTo(PendaftaranPasien::class, 'nama_pasien', 'nama_pasien');
    }

    /**
     * Relasi opsional ke tabel jenis tes (jika ada)
     */
    public function jenisTes()
    {
        return $this->belongsTo(PemeriksaanLaboratorium::class, 'jenis_tes', 'nama_tes');
    }
}
