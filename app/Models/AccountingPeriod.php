<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountingPeriod extends Model
{
    protected $fillable = ['nama_periode', 'tanggal_awal', 'tanggal_akhir', 'status'];

    public function scopeAktif($query)
    {
        return $query->where('status', 'Dibuka')->first();
    }
}
