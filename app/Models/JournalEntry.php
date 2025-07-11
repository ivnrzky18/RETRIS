<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JournalEntry extends Model
{
    
    protected $fillable = [
        'transaction_code',
        'date',
        'description',
        'created_by',
        'type',
    ];


    public function details()
    {
        return $this->hasMany(JournalDetail::class);
    }

    

}
