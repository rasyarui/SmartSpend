<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SavingTransaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','tabungan_id','amount','type'
       
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tabungan()
    {
        return $this->belongsTo(Tabungan::class);
    }   
}
