<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserActivityLog extends Model
{
    use HasFactory;
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'activity_type',
        'details',
        'ip_address',
        'user_agent',
        'occurred_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'details' => 'json',
        'occurred_at' => 'datetime',
        'created_at' => 'datetime',
    ];

    /**
     * Get the user that owns the activity log.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Get available activity types.
     */
    public static function getActivityTypes(): array
    {
        return [
            'login', 'logout', 'study', 'schedule_create', 'payment', 
            'sns_share', 'feedback', 'profile_update'
        ];
    }
    
    /**
     * Log a new activity.
     */
    public static function logActivity(int $userId, string $activityType, array $details = null, string $ipAddress = null, string $userAgent = null): self
    {
        return self::create([
            'user_id' => $userId,
            'activity_type' => $activityType,
            'details' => $details,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
            'occurred_at' => now(),
        ]);
    }
}