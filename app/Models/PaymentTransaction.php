<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentTransaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'subscription_id',
        'transaction_id',
        'amount',
        'currency',
        'payment_method',
        'status',
        'payment_date',
        'details',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'details' => 'json',
        'payment_date' => 'datetime',
    ];

    /**
     * Get the user that owns the payment transaction.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the subscription related to the payment transaction.
     */
    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }
    
    /**
     * Check if the payment is completed.
     */
    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }
    
    /**
     * Check if the payment has failed.
     */
    public function hasFailed(): bool
    {
        return $this->status === 'failed';
    }
    
    /**
     * Get available payment methods.
     */
    public static function getPaymentMethods(): array
    {
        return [
            'credit_card', 'convenience_store', 'carrier_billing', 'bank_transfer'
        ];
    }
    
    /**
     * Get available status options.
     */
    public static function getStatusOptions(): array
    {
        return [
            'pending', 'completed', 'failed', 'refunded', 'canceled'
        ];
    }
}
