<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'description',
        'amount',
        'type',
        'transaction_date',
        'category_id'
    ];

    protected $casts = [
        'transaction_date' => 'date',
        'amount' => 'decimal:2'
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Categories::class);
    }

    // Scope untuk penghasilan
    public function scopeIncome($query)
    {
        return $query->where('type', 'income');
    }

    // Scope untuk pengeluaran
    public function scopeExpense($query)
    {
        return $query->where('type', 'expense');
    }

    // Scope untuk user tertentu
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    // Accessor untuk format mata uang
    public function getFormattedAmountAttribute()
    {
        return 'Rp ' . number_format($this->amount, 0, ',', '.');
    }
}