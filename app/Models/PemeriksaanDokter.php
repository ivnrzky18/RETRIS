<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanDokter extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database
     */
    protected $table = 'pemeriksaan_dokter'; // sesuaikan dengan nama tabel di database kamu

    /**
     * Kolom yang boleh diisi secara mass assignment
     */
    protected $fillable = [
        'nama_pasien',
        'umur',
        'jenis_kelamin',
        'keluhan',
        'diagnosa',
        'tindakan',
        'tanggal_periksa',
    ];

    /**
     * (Opsional) Relasi ke tabel pasien, dokter, atau poli
     * Jika nanti tabel-tabel itu sudah tersedia.
     */
    public function pasien()
    {
        // Relasi opsional ke model Pasien (jika ada)
        return $this->belongsTo(PendaftaranPasien::class, 'nama_pasien', 'nama_pasien');
    }

    public function dokter()
    {
        // Relasi opsional ke model Dokter (jika tabel dokter sudah ada)
        return $this->belongsTo(Dokter::class, 'diagnosa', 'nama');
    }

    public function poli()
    {
        // Relasi opsional ke model Poli (jika tabel poli sudah ada)
        return $this->belongsTo(Poli::class, 'tindakan', 'nama_poli');
    }
}
