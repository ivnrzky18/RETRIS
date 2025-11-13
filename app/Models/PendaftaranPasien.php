<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranPasien extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database
     */
    protected $table = 'pendaftaran_pasiens';

    /**
     * Kolom yang boleh diisi secara mass assignment
     */
    protected $fillable = [
        'nama_pasien',
        'umur',
        'jenis_kelamin',
        'poli_tujuan',
        'dokter_tujuan',
        'tanggal_daftar',
    ];

    /**
     * (Opsional) Relasi ke tabel dokter
     * Catatan: Pastikan model Dokter dan Poli sudah ada
     * dan nama field yang direlasikan benar-benar ada.
     */
    public function dokter()
    {
        // Hanya aktifkan jika tabel dokter sudah ada
        return $this->belongsTo(Dokter::class, 'dokter_tujuan', 'nama');
    }

    public function poli()
    {
        // Hanya aktifkan jika tabel poli sudah ada
        return $this->belongsTo(Poli::class, 'poli_tujuan', 'nama_poli');
    }
}
