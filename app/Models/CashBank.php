<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashBank extends Model
{
    protected $fillable = ['tipe_transaksi', 'sumber', 'tanggal', 'deskripsi', 'jumlah', 'account_id', 'journal_entry_id'];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function journalEntry()
    {
        return $this->belongsTo(JournalEntry::class);
    }
}
