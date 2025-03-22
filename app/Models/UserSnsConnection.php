<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSnsConnection extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'sns_type',
        'sns_user_id',
        'access_token',
        'refresh_token',
        'token_expires_at',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'access_token',
        'refresh_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'token_expires_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Get the user that owns the SNS connection.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Check if the token has expired.
     */
    public function hasTokenExpired(): bool
    {
        if (!$this->token_expires_at) {
            return false;
        }
        
        return $this->token_expires_at->isPast();
    }
    
    /**
     * Get available SNS types.
     */
    public static function getSnsTypes(): array
    {
        return ['twitter', 'facebook', 'instagram', 'line', 'google'];
    }
}