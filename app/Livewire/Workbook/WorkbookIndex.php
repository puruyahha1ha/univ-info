<?php
// app/Livewire/Workbook/WorkbookIndex.php
namespace App\Livewire\Workbook;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Question;
use App\Models\QuestionCategory;
use App\Models\StudyRecord;
use Illuminate\Support\Facades\Auth;

class WorkbookIndex extends Component
{
    use WithPagination;
    
    public $selectedCategoryId = null;
    public $difficulty = null;
    public $examYear = null;
    public $questionType = null;
    public $categories = [];
    public $years = [];
    
    public function mount()
    {
        // カテゴリの取得
        $this->categories = QuestionCategory::orderBy('display_order')->get();
        
        // 出題年度の取得（ユニークな値を抽出）
        $this->years = Question::whereNotNull('exam_year')
            ->distinct('exam_year')
            ->orderBy('exam_year', 'desc')
            ->pluck('exam_year')
            ->toArray();
    }
    
    public function updatedSelectedCategoryId()
    {
        $this->resetPage();
    }
    
    public function updatedDifficulty()
    {
        $this->resetPage();
    }
    
    public function updatedExamYear()
    {
        $this->resetPage();
    }
    
    public function updatedQuestionType()
    {
        $this->resetPage();
    }
    
    public function startQuiz($questionId)
    {
        $this->redirect(route('workbook.question', ['id' => $questionId]));
    }
    
    public function render()
    {
        $query = Question::with('category')
            ->where('is_public', true);
        
        // フィルター適用
        if ($this->selectedCategoryId) {
            $query->where('category_id', $this->selectedCategoryId);
        }
        
        if ($this->difficulty) {
            $query->where('difficulty', $this->difficulty);
        }
        
        if ($this->examYear) {
            $query->where('exam_year', $this->examYear);
        }
        
        if ($this->questionType) {
            $query->where('question_type', $this->questionType);
        }
        
        $questions = $query->orderBy('created_at', 'desc')->paginate(10);
        
        return view('livewire.workbook.workbook-index', [
            'questions' => $questions
        ]);
    }
}