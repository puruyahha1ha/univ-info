<?php

namespace App\Livewire\Workbook;

use Livewire\Component;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\StudyRecord;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class QuestionView extends Component
{
    public $question;
    public $options = [];
    public $userAnswer = null;
    public $isCorrect = false;
    public $submitted = false;
    public $startTime;
    public $answerTime = 0;
    public $userNote = '';
    
    protected $rules = [
        'userAnswer' => 'required',
        'userNote' => 'nullable|string|max:1000'
    ];
    
    public function mount($id)
    {
        $this->question = Question::with('category')->findOrFail($id);
        
        if ($this->question->answer_type === 'multiple_choice') {
            $this->options = QuestionOption::where('question_id', $id)->get();
        }
        
        $this->startTime = Carbon::now();
    }
    
    public function submitAnswer()
    {
        $this->validate();
        
        // 解答時間の計算（秒）
        $this->answerTime = Carbon::now()->diffInSeconds($this->startTime);
        
        // 正誤判定
        if ($this->question->answer_type === 'multiple_choice') {
            $correctOption = QuestionOption::where('question_id', $this->question->id)
                ->where('is_correct', true)
                ->first();
                
            $this->isCorrect = ($this->userAnswer == $correctOption->id);
        } else {
            // 記述式または真偽問題の場合
            $this->isCorrect = (strtolower(trim($this->userAnswer)) === strtolower(trim($this->question->correct_answer)));
        }
        
        // 学習記録の保存
        StudyRecord::create([
            'user_id' => Auth::id(),
            'question_id' => $this->question->id,
            'answer' => $this->userAnswer,
            'is_correct' => $this->isCorrect,
            'answer_time_seconds' => $this->answerTime,
            'user_note' => $this->userNote,
            'study_datetime' => Carbon::now()
        ]);
        
        $this->submitted = true;
    }
    
    public function nextQuestion()
    {
        // 同じカテゴリの次の問題を取得
        $nextQuestion = Question::where('category_id', $this->question->category_id)
            ->where('id', '>', $this->question->id)
            ->where('is_public', true)
            ->orderBy('id')
            ->first();
            
        if (!$nextQuestion) {
            // 同じカテゴリの最初の問題へ戻る
            $nextQuestion = Question::where('category_id', $this->question->category_id)
                ->where('id', '<>', $this->question->id)
                ->where('is_public', true)
                ->orderBy('id')
                ->first();
        }
        
        if ($nextQuestion) {
            return redirect()->route('workbook.question', ['id' => $nextQuestion->id]);
        } else {
            return redirect()->route('workbook');
        }
    }
    
    public function render()
    {
        return view('livewire.workbook.question-view');
    }
}
