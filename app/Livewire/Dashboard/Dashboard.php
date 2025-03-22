<?php
// app/Livewire/Dashboard/Dashboard.php
namespace App\Livewire\Dashboard;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\StudyRecord;
use App\Models\Question;
use App\Models\Schedule;
use App\Models\PerformanceAnalytic;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public $user;
    public $studyStats = [];
    public $upcomingEvents = [];
    public $weakCategories = [];
    public $recentActivity = [];
    
    public function mount()
    {
        $this->user = Auth::user();
        $this->loadStudyStats();
        $this->loadUpcomingEvents();
        $this->loadWeakCategories();
        $this->loadRecentActivity();
    }
    
    private function loadStudyStats()
    {
        $userId = $this->user->id;
        
        // 過去7日間の学習データ
        $startDate = Carbon::now()->subDays(7);
        $endDate = Carbon::now();
        
        // 学習問題数
        $totalQuestions = StudyRecord::where('user_id', $userId)
            ->whereBetween('study_datetime', [$startDate, $endDate])
            ->count();
            
        // 正解数
        $correctAnswers = StudyRecord::where('user_id', $userId)
            ->whereBetween('study_datetime', [$startDate, $endDate])
            ->where('is_correct', true)
            ->count();
            
        // 正答率の計算
        $correctRate = $totalQuestions > 0 ? round(($correctAnswers / $totalQuestions) * 100, 1) : 0;
        
        // 総学習時間（秒）
        $totalStudyTime = StudyRecord::where('user_id', $userId)
            ->whereBetween('study_datetime', [$startDate, $endDate])
            ->sum('answer_time_seconds');
        
        // 時間と分に変換
        $hours = floor($totalStudyTime / 3600);
        $minutes = floor(($totalStudyTime % 3600) / 60);
        
        $this->studyStats = [
            'totalQuestions' => $totalQuestions,
            'correctAnswers' => $correctAnswers,
            'correctRate' => $correctRate,
            'studyTimeHours' => $hours,
            'studyTimeMinutes' => $minutes
        ];
    }
    
    private function loadUpcomingEvents()
    {
        $userId = $this->user->id;
        
        // 今日から7日間のスケジュール
        $this->upcomingEvents = Schedule::where('user_id', $userId)
            ->where('start_datetime', '>=', Carbon::now())
            ->where('start_datetime', '<=', Carbon::now()->addDays(7))
            ->where('status', 'scheduled')
            ->orderBy('start_datetime')
            ->limit(5)
            ->get();
    }
    
    private function loadWeakCategories()
    {
        $userId = $this->user->id;
        
        // 強度レベルが「弱い」のカテゴリを取得
        $this->weakCategories = PerformanceAnalytic::with('category')
            ->where('user_id', $userId)
            ->where('strength_level', 'weak')
            ->orderBy('correct_rate')
            ->limit(3)
            ->get();
    }
    
    private function loadRecentActivity()
    {
        $userId = $this->user->id;
        
        // 最近の学習記録
        $this->recentActivity = StudyRecord::with('question')
            ->where('user_id', $userId)
            ->orderBy('study_datetime', 'desc')
            ->limit(5)
            ->get();
    }
    
    public function render()
    {
        return view('livewire.dashboard.dashboard');
    }
}