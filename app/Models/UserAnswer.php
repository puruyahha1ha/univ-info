<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    use HasFactory;

    /**
     * モデルで利用可能な属性
     *
     * @var array
     */
    protected $fillable = [
        'user_id',                // ユーザーID
        'question_id',            // 問題ID
        'exam_session_id',        // 試験セッションID（任意）
        'selected_answer',        // 選択した回答（例：'ア'）
        'is_correct',             // 正誤
        'points_earned',          // 獲得点数
        'answer_time',            // 回答にかかった時間（秒）
        'viewed_explanation',     // 解説を閲覧したか
        'marked_for_review',      // 見直し用にマークしたか
    ];

    /**
     * キャストする属性
     *
     * @var array
     */
    protected $casts = [
        'is_correct' => 'boolean',
        'viewed_explanation' => 'boolean',
        'marked_for_review' => 'boolean',
    ];

    /**
     * ユーザーとの関連
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 問題との関連
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    /**
     * 試験セッションとの関連
     */
    public function examSession()
    {
        return $this->belongsTo(ExamSession::class);
    }

    /**
     * 正解の回答のみを取得するスコープ
     */
    public function scopeCorrect($query)
    {
        return $query->where('is_correct', true);
    }

    /**
     * 不正解の回答のみを取得するスコープ
     */
    public function scopeIncorrect($query)
    {
        return $query->where('is_correct', false);
    }

    /**
     * 特定のカテゴリの問題に対する回答を取得するスコープ
     */
    public function scopeCategory($query, $category)
    {
        return $query->whereHas('question', function ($q) use ($category) {
            $q->where('category', $category);
        });
    }

    /**
     * 見直し用にマークされた回答を取得するスコープ
     */
    public function scopeMarkedForReview($query)
    {
        return $query->where('marked_for_review', true);
    }

    /**
     * 指定された期間内の回答を取得するスコープ
     */
    public function scopeWithinPeriod($query, $startDate, $endDate)
    {
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }
}
