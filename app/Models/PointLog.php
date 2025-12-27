<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointLog extends Model
{
    use HasFactory;

    // Tambahkan baris ini untuk mengizinkan input data ke kolom berikut
    protected $fillable = [
        'user_id',
        'amount',
        'description',
    ];

    /**
     * Relasi ke User (Opsional tapi disarankan)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}