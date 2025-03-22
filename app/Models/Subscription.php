<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subscription extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'plan_type',
        'start_date',
        'end_date',
        'status',
        'auto_renewal',
        'original_transaction_id',
        'latest_transaction_id',
        'trial_ends_at',
        'canceled_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'auto_renewal' => 'boolean',
        'trial_ends_at' => 'date',
        'canceled_at' => 'datetime',
    ];

    /**
     * Get the user that owns the subscription.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the payment transactions for the subscription.
     */
    public function paymentTransactions(): HasMany
    {
        return $this->hasMany(PaymentTransaction::class);
    }
    
    /**
     * Check if subscription is active.
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }
    
    /**
     * Check if subscription has expired.
     */
    public function hasExpired(): bool
    {
        if ($this->end_date === null) {
            return false;
        }
        
        return $this->end_date < now()->toDateString();
    }
}