<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudyRecord extends Model
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
        'answer',
        'is_correct',
        'answer_time_seconds',
        'score',
        'user_note',
        'study_datetime',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_correct' => 'boolean',
        'answer_time_seconds' => 'integer',
        'score' => 'integer',
        'study_datetime' => 'datetime',
    ];

    /**
     * Get the user that owns the study record.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the question related to the study record.
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}