<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TrashCollection extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'officer_id', 
        'status', 
        'collected_at'
    ];

    /**
     * PERBAIKAN: Menambahkan Casting Tanggal
     * Ini agar $item->collected_at bisa langsung menggunakan fungsi ->format()
     */
    protected $casts = [
        'collected_at' => 'datetime',
    ];

    // Relasi: Data angkutan ini milik rumah/warga siapa?
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi: Siapa petugas yang mengangkutnya?
    public function officer()
    {
        return $this->belongsTo(User::class, 'officer_id');
    }
}