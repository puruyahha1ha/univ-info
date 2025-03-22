<?php
// app/Models/AiQuestionGeneration.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AiQuestionGeneration extends Model
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
        'difficulty',
        'number_of_questions',
        'generation_parameters',
        'status',
        'error_message',
        'completed_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'difficulty' => 'integer',
        'number_of_questions' => 'integer',
        'generation_parameters' => 'json',
        'completed_at' => 'datetime',
    ];

    /**
     * Get the user that owns the AI question generation.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category related to the AI question generation.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(QuestionCategory::class, 'category_id');
    }
    
    /**
     * Check if the generation is completed.
     */
    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }
    
    /**
     * Check if the generation has failed.
     */
    public function hasFailed(): bool
    {
        return $this->status === 'failed';
    }
}