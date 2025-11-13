<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyewa extends Model // Mengubah nama Model menjadi Penyewa
{
    use HasFactory;

    protected $table = 'penyewa'; // Mengubah nama tabel database menjadi 'penyewa'

    protected $fillable = [
        'nama',
        'jenis_kelamin', // Mengubah dari 'spesialis'
        'no_hp',
        'alamat',
        'pekerjaan', // Menambahkan field yang relevan untuk penyewa
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}