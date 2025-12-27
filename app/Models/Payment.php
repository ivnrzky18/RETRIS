<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    // Tambahkan 'month' ke dalam array fillable agar bisa disimpan ke database
    protected $fillable = ['user_id', 'type', 'amount', 'month', 'status'];

    // Relasi: Pembayaran ini milik warga siapa?
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}