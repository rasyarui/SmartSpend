<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tabungan extends Model
{

    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'target_amount',
        'current_amount',
        'priority',
        'category',
        'deadline',
    ];

    protected $casts = [
        'deadline' => 'date',
        'target_amount' => 'decimal:2',
        'current_amount' => 'decimal:2'
    ];
    protected $attributes = [
        'current_amount' => 0,
    ];

    public function getPriorityColorAttribute()
    {
        return match ($this->priority) {
            'low' => 'text-green-500 bg-green-500/10 border-green-500/20',
            'medium' => 'text-yellow-500 bg-yellow-500/10 border-yellow-500/20',
            'high' => 'text-red-500 bg-red-500/10 border-red-500/20',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    // Accessor: Label lengkap
    public function getPriorityLabelAttribute()
    {
        return match ($this->priority) {
            'low' => 'Rendah',
            'medium' => 'Sedang',
            'high' => 'Tinggi',
            default => 'Tidak diketahui'
        };
    }
    public function getProgressAttribute()
    {
        if ($this->target_amount == 0) return 0;
        return min(100, (int) (($this->current_amount / $this->target_amount) * 100));
    }
    public function getIsCompletedAttribute()
    {
        return $this->current_amount >= $this->target_amount;
    }
    public function getIsInProgressAttribute()
    {
        return ! $this->Completed;
    }



    public function getDaysRemainingBadgeAttribute()
    {
        if ($this->isCompleted) {
            return (object)
            [
                'label' => 'Selesai 🥳',
                'color' => 'text-green-500',
                'days' => 0,
                'status' => 'completed',
            ];
        }

        if (! $this->deadline) {
            return null;
        }

        $today = now()->startOfDay();
        $deadline = $this->deadline->startOfDay();

        $diffInDays = $deadline->diffInDays($today, false);

        $days = abs($diffInDays);

        $status = match (true) {
            $deadline->isBefore($today) => 'late',
            $diffInDays == 0 => 'today',    // hari ini
            default => 'progress',            // masih jauh
        };

        $label = match ($status) {
            'late' => "Telat {$days} hari",
            'today' => "Hari ini!",
            default => "{$days} hari lagi"
        };

        $color = match ($status) {
            'late' => 'text-red-500',
            'today' => 'text-yellow-500',
            'progress' => 'text-blue-500',
        };


        return (object) [
            'label' => $label,
            'color' => $color,
            'raw' => $diffInDays,
            'status' => $status,
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function savingTransactions()
    {
        return $this->hasMany(SavingTransaction::class);
    }

    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function openModal($type)
    {
        $this->showModal = true;
        $this->resetForm();
    }
}
