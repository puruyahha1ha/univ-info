<?php
// app/Livewire/Analysis/AnalysisIndex.php
namespace App\Livewire\Analysis;

use Livewire\Component;
use App\Models\StudyRecord;
use App\Models\PerformanceAnalytic;
use App\Models\QuestionCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AnalysisIndex extends Component
{
    public $timeRange = 'month';
    public $categoryId = null;
    public $categories = [];
    public $studySummary = [];
    public $categoryPerformance = [];
    public $trendsData = [];
    
    public function mount()
    {
        $this->categories = QuestionCategory::orderBy('display_order')->get();
        $this->loadAnalysisData();
    }
    
    public function updatedTimeRange()
    {
        $this->loadAnalysisData();
    }
    
    public function updatedCategoryId()
    {
        $this->loadAnalysisData();
    }
    
    private function loadAnalysisData()
    {
        $userId = Auth::id();
        
        // 時間範囲の設定
        $startDate = $this->getStartDate();
        $endDate = Carbon::now();
        
        // 学習サマリーの取得
        $this->loadStudySummary($userId, $startDate, $endDate);
        
        // カテゴリ別成績の取得
        $this->loadCategoryPerformance($userId, $startDate, $endDate);
        
        // トレンドデータの取得
        $this->loadTrendsData($userId, $startDate, $endDate);
    }
    
    private function getStartDate()
    {
        $now = Carbon::now();
        
        switch ($this->timeRange) {
            case 'week':
                return $now->copy()->subWeek();
            case 'month':
                return $now->copy()->subMonth();
            case 'quarter':
                return $now->copy()->subMonths(3);
            case 'year':
                return $now->copy()->subYear();
            default:
                return $now->copy()->subMonth();
        }
    }
    
    private function loadStudySummary($userId, $startDate, $endDate)
    {
        // 問題数、正解数、正答率、学習時間
        $records = StudyRecord::where('user_id', $userId)
            ->whereBetween('study_datetime', [$startDate, $endDate]);
            
        // カテゴリフィルターの適用
        if ($this->categoryId) {
            $records->whereHas('question', function ($query) {
                $query->where('category_id', $this->categoryId);
            });
        }
        
        $stats = $records->get();
        
        $totalQuestions = $stats->count();
        $correctAnswers = $stats->where('is_correct', true)->count();
        $correctRate = $totalQuestions > 0 ? round(($correctAnswers / $totalQuestions) * 100, 1) : 0;
        $totalTime = $stats->sum('answer_time_seconds');
        
        // 時間と分に変換
        $hours = floor($totalTime / 3600);
        $minutes = floor(($totalTime % 3600) / 60);
        
        $this->studySummary = [
            'totalQuestions' => $totalQuestions,
            'correctAnswers' => $correctAnswers,
            'correctRate' => $correctRate,
            'studyTimeHours' => $hours,
            'studyTimeMinutes' => $minutes,
            'avgTimePerQuestion' => $totalQuestions > 0 ? round($totalTime / $totalQuestions) : 0
        ];
    }
    
    private function loadCategoryPerformance($userId, $startDate, $endDate)
    {
        $categoryPerformance = [];
        
        // 親カテゴリを取得
        $parentCategories = QuestionCategory::whereNull('parent_id')->get();
        
        foreach ($parentCategories as $category) {
            // そのカテゴリとサブカテゴリのIDを取得
            $categoryIds = [$category->id];
            $subcategories = QuestionCategory::where('parent_id', $category->id)->pluck('id')->toArray();
            $categoryIds = array_merge($categoryIds, $subcategories);
            
            // カテゴリに関連する学習記録を取得
            $records = StudyRecord::where('user_id', $userId)
                ->whereBetween('study_datetime', [$startDate, $endDate])
                ->whereHas('question', function ($query) use ($categoryIds) {
                    $query->whereIn('category_id', $categoryIds);
                })
                ->get();
                
            $totalQuestions = $records->count();
            $correctAnswers = $records->where('is_correct', true)->count();
            $correctRate = $totalQuestions > 0 ? round(($correctAnswers / $totalQuestions) * 100, 1) : 0;
            
            // 強み/弱みの判定
            $strengthLevel = 'average';
            if ($correctRate >= 80) {
                $strengthLevel = 'strong';
            } elseif ($correctRate < 60) {
                $strengthLevel = 'weak';
            }
            
            $categoryPerformance[] = [
                'id' => $category->id,
                'name' => $category->name,
                'totalQuestions' => $totalQuestions,
                'correctAnswers' => $correctAnswers,
                'correctRate' => $correctRate,
                'strengthLevel' => $strengthLevel
            ];
            
            // PerformanceAnalytics テーブルの更新または作成
            PerformanceAnalytic::updateOrCreate(
                ['user_id' => $userId, 'category_id' => $category->id],
                [
                    'correct_rate' => $correctRate,
                    'total_questions' => $totalQuestions,
                    'total_correct' => $correctAnswers,
                    'strength_level' => $strengthLevel,
                    'last_study_date' => $totalQuestions > 0 ? Carbon::now()->toDateString() : null
                ]
            );
        }
        
        // 正答率で降順ソート
        usort($categoryPerformance, function ($a, $b) {
            return $b['correctRate'] <=> $a['correctRate'];
        });
        
        $this->categoryPerformance = $categoryPerformance;
    }
    
    private function loadTrendsData($userId, $startDate, $endDate)
    {
        $interval = 'day';
        $format = 'Y-m-d';
        
        if ($this->timeRange === 'quarter' || $this->timeRange === 'year') {
            $interval = 'week';
            $format = 'Y-m-d';
        }
        
        $query = StudyRecord::where('user_id', $userId)
            ->whereBetween('study_datetime', [$startDate, $endDate]);
            
        // カテゴリフィルターの適用
        if ($this->categoryId) {
            $query->whereHas('question', function ($q) {
                $q->where('category_id', $this->categoryId);
            });
        }
        
        // 日付でグループ化
        $rawData = $query->select(
            DB::raw("DATE_FORMAT(study_datetime, '{$format}') as date"),
            DB::raw('COUNT(*) as total'),
            DB::raw('SUM(CASE WHEN is_correct = 1 THEN 1 ELSE 0 END) as correct')
        )
        ->groupBy('date')
        ->orderBy('date')
        ->get();
        
        // トレンドデータの整形
        $trendsData = [];
        
        // 期間内のすべての日付を生成
        $currentDate = $startDate->copy();
        while ($currentDate <= $endDate) {
            $dateStr = $currentDate->format($format);
            $dayData = $rawData->firstWhere('date', $dateStr);
            
            $total = $dayData ? $dayData->total : 0;
            $correct = $dayData ? $dayData->correct : 0;
            $rate = $total > 0 ? round(($correct / $total) * 100, 1) : 0;
            
            $trendsData[] = [
                'date' => $dateStr,
                'total' => $total,
                'correct' => $correct,
                'rate' => $rate
            ];
            
            if ($interval === 'day') {
                $currentDate->addDay();
            } else {
                $currentDate->addWeek();
            }
        }
        
        $this->trendsData = $trendsData;
    }
    
    public function render()
    {
        return view('livewire.analysis.analysis-index');
    }
}