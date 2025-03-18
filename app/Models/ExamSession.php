<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSession extends Model
{
    use HasFactory;

    /**
     * モデルで利用可能な属性
     *
     * @var array
     */
    protected $fillable = [
        'user_id',              // ユーザーID
        'title',                // タイトル（例：「2023年度模擬試験」）
        'type',                 // 種類（year:年度別、mock:模擬試験、custom:カスタム、weakness:弱点克服）
        'year',                 // 年度（年度別の場合）
        'status',               // 状態（in_progress:実行中、completed:完了、abandoned:中断）
        'total_questions',      // 問題総数
        'correct_answers',      // 正解数
        'total_points',         // 総獲得点数
        'max_points',           // 満点
        'started_at',           // 開始時間
        'completed_at',         // 完了時間
        'time_spent',           // 所要時間（秒）
        'settings',             // 試験の設定（JSON、カテゴリ制限や時間制限など）
    ];

    /**
     * JSONにキャストする属性
     *
     * @var array
     */
    protected $casts = [
        'settings' => 'array',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    /**
     * ユーザーとの関連
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 問題との関連（多対多）
     */
    public function questions()
    {
        return $this->belongsToMany(Question::class, 'exam_session_questions')
            ->withPivot('order')
            ->withTimestamps();
    }

    /**
     * ユーザーの回答との関連
     */
    public function userAnswers()
    {
        return $this->hasMany(UserAnswer::class);
    }

    /**
     * 進行中のセッションを取得するスコープ
     */
    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress');
    }

    /**
     * 完了したセッションを取得するスコープ
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * 特定のタイプのセッションを取得するスコープ
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * 特定の年度のセッションを取得するスコープ
     */
    public function scopeOfYear($query, $year)
    {
        return $query->where('year', $year);
    }

    /**
     * 正答率を計算するメソッド
     */
    public function getCorrectPercentageAttribute()
    {
        if ($this->total_questions == 0) {
            return 0;
        }
        return round(($this->correct_answers / $this->total_questions) * 100, 1);
    }

    /**
     * スコア率を計算するメソッド
     */
    public function getScorePercentageAttribute()
    {
        if ($this->max_points == 0) {
            return 0;
        }
        return round(($this->total_points / $this->max_points) * 100, 1);
    }

    /**
     * 所要時間を時間:分:秒形式で取得するメソッド
     */
    public function getFormattedTimeSpentAttribute()
    {
        $hours = floor($this->time_spent / 3600);
        $minutes = floor(($this->time_spent % 3600) / 60);
        $seconds = $this->time_spent % 60;

        if ($hours > 0) {
            return sprintf('%d時間%02d分%02d秒', $hours, $minutes, $seconds);
        } else {
            return sprintf('%d分%02d秒', $minutes, $seconds);
        }
    }
}
