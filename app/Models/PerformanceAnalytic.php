<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PerformanceAnalytic extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'category_id',
        'correct_rate',
        'total_questions',
        'total_correct',
        'average_answer_time',
        'strength_level',
        'total_study_time_minutes',
        'last_study_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'correct_rate' => 'float',
        'total_questions' => 'integer',
        'total_correct' => 'integer',
        'average_answer_time' => 'float',
        'total_study_time_minutes' => 'integer',
        'last_study_date' => 'date',
    ];

    /**
     * Get the user that owns the performance analytic.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category related to the performance analytic.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(QuestionCategory::class, 'category_id');
    }
}