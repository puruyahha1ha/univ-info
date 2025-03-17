<?php

namespace App\Livewire\Workbook;

use Livewire\Component;
use Livewire\WithPagination;

class Workbook extends Component
{
    // use App\Models\Workbook;
    // use App\Models\WorkbookCategory;
    // use App\Models\UserWorkbookProgress;

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
        // $query = Workbook::query();

        // // 検索フィルター適用
        // if ($this->search) {
        //     $query->where('title', 'like', '%' . $this->search . '%')
        //         ->orWhere('description', 'like', '%' . $this->search . '%');
        // }

        // // 年度フィルター
        // if ($this->yearFilter) {
        //     $query->where('year', $this->yearFilter);
        // }

        // // カテゴリフィルター
        // if ($this->categoryFilter) {
        //     $query->whereHas('categories', function ($q) {
        //         $q->where('workbook_categories.id', $this->categoryFilter);
        //     });
        // }

        // // 難易度フィルター
        // if ($this->difficultyFilter) {
        //     $query->where('difficulty', $this->difficultyFilter);
        // }

        // $workbooks = $query->paginate(9);
        // 空の配列を返す
        $workbooks = collect();
        // $categories = WorkbookCategory::all();
        $categories = collect();
        // $years = Workbook::select('year')->distinct()->orderBy('year', 'desc')->pluck('year');
        $years = collect();
        // ユーザーの進捗状況を取得
        $userProgress = [];
        if (auth()->check()) {
            $userProgress = UserWorkbookProgress::where('user_id', auth()->id())
                ->get()
                ->keyBy('workbook_id');
        }

        // 統計データを取得
        $stats = $this->getUserStats();

        return view('livewire.workbook.workbook', [
            'workbooks' => $workbooks,
            'categories' => $categories,
            'years' => $years,
            'userProgress' => $userProgress,
            'stats' => $stats
        ]);
    }

    public function getUserStats()
    {
        if (!auth()->check()) {
            return [
                'total_completed' => 0,
                'total_pending' => 0,
                'correct_rate' => 0,
                'weak_category' => null
            ];
        }

        $userId = auth()->id();

        // 解答済み問題数
        // $totalCompleted = UserWorkbookProgress::where('user_id', $userId)
        //     ->where('is_completed', true)
        //     ->count();
        $totalCompleted = 0;
        // 未解答問題数
        // $totalWorkbooks = Workbook::count();
        $totalWorkbooks = 0;
        $totalPending = $totalWorkbooks - $totalCompleted;

        // 正答率
        // $correctRate = UserWorkbookProgress::where('user_id', $userId)
            // ->where('is_completed', true)
            // ->avg('correct_rate') ?? 0;
        $correctRate = 0;

        // 弱点カテゴリ（正答率が最も低いカテゴリ）
        // $weakCategoryId = UserWorkbookProgress::where('user_id', $userId)
        //     ->where('is_completed', true)
        //     ->join('workbook_workbook_category', 'user_workbook_progress.workbook_id', '=', 'workbook_workbook_category.workbook_id')
        //     ->join('workbook_categories', 'workbook_workbook_category.workbook_category_id', '=', 'workbook_categories.id')
        //     ->select('workbook_categories.id', 'workbook_categories.name', \DB::raw('AVG(user_workbook_progress.correct_rate) as avg_rate'))
        //     ->groupBy('workbook_categories.id', 'workbook_categories.name')
        //     ->orderBy('avg_rate', 'asc')
        //     ->first();
        $weakCategoryId = null;
        return [
            'total_completed' => $totalCompleted,
            'total_pending' => $totalPending,
            'correct_rate' => round($correctRate),
            'weak_category' => $weakCategoryId ? $weakCategoryId->name : null
        ];
    }

    public function resetFilters()
    {
        $this->reset(['search', 'yearFilter', 'categoryFilter', 'difficultyFilter']);
    }
}
