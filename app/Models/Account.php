<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
     protected $fillable = ['code', 'name', 'type', 'normal_balance'];

    public function journalDetails()
    {
        return $this->hasMany(JournalDetail::class);
    }

}
