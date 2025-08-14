<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Categories extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category',
        'type',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    // Scope untuk kategori user tertentu
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    // Scope untuk kategori aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk kategori berdasarkan tipe
    public function scopeForType($query, $type)
    {
        return $query->where(function($q) use ($type) {
            $q->where('type', $type)->orWhere('type', 'both');
        });
    }

    // Accessor untuk menghitung total transaksi
    public function getTotalTransactionsAttribute()
    {
        return $this->transactions()->sum('amount');
    }

    // Accessor untuk menghitung jumlah transaksi
    public function getTransactionCountAttribute()
    {
        return $this->transactions()->count();
    }
}