<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'content',
        'correct_answer',
        'explanation',
        'category_id',
        'difficulty',
        'correct_rate',
        'exam_year',
        'question_type',
        'is_public',
        'answer_type',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'difficulty' => 'integer',
        'correct_rate' => 'float',
        'exam_year' => 'integer',
        'is_public' => 'boolean',
    ];

    /**
     * Get the category that owns the question.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(QuestionCategory::class, 'category_id');
    }

    /**
     * Get the options for the question.
     */
    public function options(): HasMany
    {
        return $this->hasMany(QuestionOption::class);
    }

    /**
     * Get the study records for the question.
     */
    public function studyRecords(): HasMany
    {
        return $this->hasMany(StudyRecord::class);
    }

    /**
     * Get the feedback for the question.
     */
    public function feedback(): HasMany
    {
        return $this->hasMany(Feedback::class);
    }
}