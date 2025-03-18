<?php

namespace App\Livewire\Workbook;

use App\Models\Question;
use App\Models\ExamSession;
use App\Models\UserAnswer;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Workbook extends Component
{
    use WithPagination;

    public $search = '';
    public $yearFilter = '';
    public $categoryFilter = '';
    public $difficultyFilter = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'yearFilter' => ['except' => ''],
        'categoryFilter' => ['except' => ''],
        'difficultyFilter' => ['except' => ''],
    ];

    public function render()
    {
        $query = Question::query()->where('is_active', true);

        // 検索フィルター適用
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('question_text', 'like', '%' . $this->search . '%')
                    ->orWhereJsonContains('tags', $this->search);
            });
        }

        // 年度フィルター
        if ($this->yearFilter) {
            $query->where('year', $this->yearFilter);
        }

        // カテゴリフィルター
        if ($this->categoryFilter) {
            $query->where('category', $this->categoryFilter);
        }

        // 難易度フィルター
        if ($this->difficultyFilter) {
            $query->where('difficulty', $this->difficultyFilter);
        }

        $questions = $query->paginate(15);

        // カテゴリ一覧を取得
        $categories = Question::select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        // 年度一覧を取得
        $years = Question::select('year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        // 難易度一覧
        $difficulties = [1, 2, 3, 4, 5];

        // ユーザーの進捗状況を取得
        $userProgress = [];
        if (Auth::check()) {
            $answeredQuestionIds = UserAnswer::where('user_id', Auth::id())
                ->pluck('question_id')
                ->toArray();

            $correctQuestionIds = UserAnswer::where('user_id', Auth::id())
                ->where('is_correct', true)
                ->pluck('question_id')
                ->toArray();

            $userProgress = [
                'answered_questions' => $answeredQuestionIds,
                'correct_questions' => $correctQuestionIds,
            ];
        }

        // 統計データを取得
        $stats = $this->getUserStats();

        return view('livewire.workbook.workbook', [
            'questions' => $questions,
            'categories' => $categories,
            'years' => $years,
            'difficulties' => $difficulties,
            'userProgress' => $userProgress,
            'stats' => $stats
        ]);
    }

    // 検索が変更された時に実行される更新メソッドを追加
    public function updatedSearch()
    {
        // 検索が変更されたらページをリセット（ページネーションの問題を避けるため）
        $this->resetPage();
    }

    public function updatedYearFilter()
    {
        $this->resetPage();
    }

    public function updatedCategoryFilter()
    {
        $this->resetPage();
    }

    public function updatedDifficultyFilter()
    {
        $this->resetPage();
    }

    /**
     * ユーザーの学習統計を取得
     */
    public function getUserStats()
    {
        if (!Auth::check()) {
            return [
                'total_completed' => 0,
                'total_pending' => 0,
                'correct_rate' => 0,
                'weak_category' => null,
                'answered_questions' => 0,
                'total_questions' => 0,
                'answered_percentage' => 0,
                'correct_percentage' => 0,
                'study_time' => '0時間0分',
                'recent_sessions' => []
            ];
        }

        $userId = Auth::id();
        $totalQuestions = Question::where('is_active', true)->count();

        // 解答済み問題数（重複を除く）
        $answeredQuestions = UserAnswer::where('user_id', $userId)
            ->distinct('question_id')
            ->count('question_id');

        // 未解答問題数
        $totalPending = $totalQuestions - $answeredQuestions;

        // 正答率
        $totalAnswers = UserAnswer::where('user_id', $userId)->count();
        $correctAnswers = UserAnswer::where('user_id', $userId)
            ->where('is_correct', true)
            ->count();

        $correctRate = $totalAnswers > 0 ? ($correctAnswers / $totalAnswers) * 100 : 0;
        $answeredPercentage = $totalQuestions > 0 ? ($answeredQuestions / $totalQuestions) * 100 : 0;

        // 弱点カテゴリ（正答率が最も低いカテゴリ）
        $categoryStats = DB::table('user_answers')
            ->join('questions', 'user_answers.question_id', '=', 'questions.id')
            ->where('user_answers.user_id', $userId)
            ->groupBy('questions.category')
            ->select(
                'questions.category',
                DB::raw('COUNT(*) as total_answers'),
                DB::raw('SUM(CASE WHEN user_answers.is_correct = 1 THEN 1 ELSE 0 END) as correct_answers')
            )
            ->having('total_answers', '>=', 5) // 最低5問以上解いたカテゴリのみ
            ->get();

        $weakCategory = null;
        $lowestRate = 100;

        foreach ($categoryStats as $stat) {
            $rate = ($stat->correct_answers / $stat->total_answers) * 100;
            if ($rate < $lowestRate) {
                $lowestRate = $rate;
                $weakCategory = $stat->category;
            }
        }

        // 学習時間の集計
        $totalSeconds = ExamSession::where('user_id', $userId)
            ->where('status', 'completed')
            ->sum('time_spent');

        $hours = floor($totalSeconds / 3600);
        $minutes = floor(($totalSeconds % 3600) / 60);
        $studyTime = "{$hours}時間{$minutes}分";

        // 最近のセッション
        $recentSessions = ExamSession::where('user_id', $userId)
            ->where('status', 'completed')
            ->orderBy('completed_at', 'desc')
            ->limit(5)
            ->get();

        return [
            'total_completed' => $answeredQuestions,
            'total_pending' => $totalPending,
            'correct_rate' => round($correctRate),
            'weak_category' => $weakCategory,
            'answered_questions' => $answeredQuestions,
            'total_questions' => $totalQuestions,
            'answered_percentage' => round($answeredPercentage),
            'correct_percentage' => round($correctRate),
            'study_time' => $studyTime,
            'recent_sessions' => $recentSessions
        ];
    }

    /**
     * フィルターをリセット
     */
    public function resetFilters()
    {
        $this->reset(['search', 'yearFilter', 'categoryFilter', 'difficultyFilter']);
    }
}
