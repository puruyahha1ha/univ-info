<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feedback extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'question_id',
        'feedback_type',
        'content',
        'rating',
        'status',
        'admin_response',
        'submitted_at',
        'resolved_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'rating' => 'integer',
        'submitted_at' => 'datetime',
        'resolved_at' => 'datetime',
    ];

    /**
     * Get the user that submitted the feedback.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the question related to the feedback.
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
    
    /**
     * Check if the feedback is resolved.
     */
    public function isResolved(): bool
    {
        return $this->status === 'resolved' || $this->status === 'closed';
    }
    
    /**
     * Get available feedback types.
     */
    public static function getFeedbackTypes(): array
    {
        return ['bug', 'suggestion', 'satisfaction', 'content', 'other'];
    }
    
    /**
     * Get available status options.
     */
    public static function getStatusOptions(): array
    {
        return ['new', 'in_progress', 'resolved', 'closed'];
    }
}
