<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Mengubah nama model dari Pembayaran menjadi PembayaranSewa
class PembayaranSewa extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database (asumsi Anda akan membuat tabel baru bernama 'pembayaran_sewa')
     */
    protected $table = 'pembayaran_sewa'; 

    /**
     * Kolom yang boleh diisi secara mass assignment
     */
    protected $fillable = [
        // Mengubah nama_pasien menjadi nama_penyewa
        'nama_penyewa', 
        'jumlah',
        'metode_pembayaran',
        'tanggal_pembayaran',
        // Tambahkan relasi ID jika menggunakan foreign key
        // 'penyewa_id', 
        // 'kamar_id',
    ];

    /**
     * Relasi opsional ke tabel Penyewa
     * Catatan: Jika Anda menggunakan ID (penyewa_id) sebagai foreign key, 
     * sebaiknya ubah field 'nama_penyewa' di atas menjadi 'penyewa_id' 
     * dan hapus relasi berdasarkan nama.
     */
    public function penyewa()
    {
        // Asumsi relasi berdasarkan ID penyewa
        // return $this->belongsTo(Penyewa::class, 'penyewa_id');

        // Jika masih menggunakan nama_penyewa sebagai kolom:
        return $this->belongsTo(Penyewa::class, 'nama_penyewa', 'nama');
    }
}