<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuestionCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'parent_id',
        'description',
        'display_order',
    ];

    /**
     * Get the parent category.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(QuestionCategory::class, 'parent_id');
    }

    /**
     * Get the child categories.
     */
    public function children(): HasMany
    {
        return $this->hasMany(QuestionCategory::class, 'parent_id');
    }

    /**
     * Get the questions for the category.
     */
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class, 'category_id');
    }

    /**
     * Get the performance analytics for the category.
     */
    public function performanceAnalytics(): HasMany
    {
        return $this->hasMany(PerformanceAnalytic::class, 'category_id');
    }
}