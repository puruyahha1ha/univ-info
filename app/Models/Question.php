<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /** @use HasFactory<\Database\Factories\QuestionFactory> */
    use HasFactory;

    /**
     * モデルで利用可能な属性
     *
     * @var array
     */
    protected $fillable = [
        'year',                  // 問題の年度
        'number',                // 問題番号
        'category',              // カテゴリ（アルゴリズム、データベースなど）
        'difficulty',            // 難易度（1-5）
        'points',                // 配点
        'question_text',         // 問題文（HTML形式可）
        'image_path',            // 画像パス（あれば）
        'choices',               // 選択肢（JSON形式で保存）
        'correct_answer',        // 正解（選択肢のキー、例：'ア'）
        'explanation',           // 解説（HTML形式可）
        'tags',                  // タグ（JSONで保存、検索用）
        'is_active',             // アクティブ状態（表示/非表示）
    ];

    /**
     * JSONにキャストする属性
     *
     * @var array
     */
    protected $casts = [
        'choices' => 'array',
        'tags' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * ユーザーの回答との関連
     */
    public function userAnswers()
    {
        return $this->hasMany(UserAnswer::class);
    }

    /**
     * 試験セッションとの関連（多対多）
     */
    public function examSessions()
    {
        return $this->belongsToMany(ExamSession::class, 'exam_session_questions')
            ->withPivot('order')
            ->withTimestamps();
    }

    /**
     * カテゴリでフィルタリングするスコープ
     */
    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * 年度でフィルタリングするスコープ
     */
    public function scopeYear($query, $year)
    {
        return $query->where('year', $year);
    }
    
    /**
     * 難易度でフィルタリングするスコープ
     */
    public function scopeDifficulty($query, $difficulty)
    {
        return $query->where('difficulty', $difficulty);
    }
    
    /**
     * タグでフィルタリングするスコープ
     */
    public function scopeHasTag($query, $tag)
    {
        return $query->whereJsonContains('tags', $tag);
    }
    
    /**
     * アクティブな問題のみを取得するスコープ
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
