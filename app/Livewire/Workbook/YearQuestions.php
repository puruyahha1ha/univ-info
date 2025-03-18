<?php

namespace App\Livewire\Workbook;

use App\Models\ExamSession;
use App\Models\Question;
use App\Models\UserAnswer;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class YearQuestions extends Component
{
    public $year;
    public $questions = [];
    public $currentQuestionIndex = 0;
    public $selectedAnswer = null;
    public $showResult = false;
    public $isLastQuestion = false;
    public $answers = [];
    public $score = 0;
    public $examSession = null;
    public $startTime = null;
    public $answerStartTime = null;

    public function mount($year)
    {
        $this->year = $year;
        $this->startTime = now();
        $this->answerStartTime = now();

        // 試験セッションを作成
        $this->createExamSession();

        // 問題をロード
        $this->loadQuestions();

        $this->isLastQuestion = $this->currentQuestionIndex === count($this->questions) - 1;
    }

    /**
     * 試験セッションを作成
     */
    private function createExamSession()
    {
        // ログインユーザーのIDを取得（未ログインの場合はnull）
        $userId = Auth::id();

        // 未ログイン時の処理
        if (!$userId) {
            // 試験セッションを作成せず、プロパティのみ設定
            $this->examSession = (object)[
                'id' => null,
                'questions' => collect([])
            ];
            return;
        }

        // ログイン済みの場合、試験セッションを作成
        $this->examSession = ExamSession::create([
            'user_id' => $userId,
            'title' => $this->year . '年度 共通テスト情報Ⅰ',
            'type' => 'year',
            'year' => $this->year,
            'status' => 'in_progress',
            'started_at' => now(),
            'settings' => [
                'show_explanation' => true,
                'randomize_order' => false,
            ]
        ]);
    }

    /**
     * 問題をロード
     */
    public function loadQuestions()
    {
        // 年度に応じた問題をデータベースから取得
        $questionsCollection = Question::where('year', $this->year)
            ->where('is_active', true)
            ->orderBy('number')
            ->get();

        if ($questionsCollection->isEmpty()) {
            // 問題が見つからない場合はダミーデータを使用
            $this->questions = $this->getDummyQuestions();
        } else {
            // DBから取得した問題を処理
            $this->questions = $questionsCollection->toArray();

            // ログイン中のみ試験セッションと問題を関連付け
            if (Auth::check() && $this->examSession && isset($this->examSession->id)) {
                $orderNumber = 1;
                foreach ($questionsCollection as $question) {
                    $this->examSession->questions()->attach($question->id, ['order' => $orderNumber]);
                    $orderNumber++;
                }

                // 試験の合計点数と問題数を更新
                $this->examSession->update([
                    'total_questions' => count($this->questions),
                    'max_points' => $questionsCollection->sum('points')
                ]);
            }
        }
    }

    /**
     * 回答を選択
     */
    public function selectAnswer($key)
    {
        if ($this->showResult) {
            return;
        }

        $this->selectedAnswer = $key;
    }

    /**
     * 回答を確認
     */
    public function checkAnswer()
    {
        if (!$this->selectedAnswer) {
            return;
        }

        $currentQuestion = $this->questions[$this->currentQuestionIndex];
        $isCorrect = $this->selectedAnswer === $currentQuestion['correct_answer'];
        $pointsEarned = $isCorrect ? $currentQuestion['points'] : 0;

        // 回答にかかった時間を計算（秒）
        $answerTime = now()->diffInSeconds($this->answerStartTime);

        // 回答を記録
        $this->answers[$this->currentQuestionIndex] = [
            'selected' => $this->selectedAnswer,
            'correct' => $isCorrect,
            'points' => $pointsEarned,
            'time' => $answerTime
        ];

        // スコアを更新
        if ($isCorrect) {
            $this->score += $currentQuestion['points'];
        }

        // ログインユーザーの場合、回答をデータベースに保存
        if (Auth::check()) {
            UserAnswer::create([
                'user_id' => Auth::id(),
                'question_id' => $currentQuestion['id'],
                'exam_session_id' => $this->examSession->id,
                'selected_answer' => $this->selectedAnswer,
                'is_correct' => $isCorrect,
                'points_earned' => $pointsEarned,
                'answer_time' => $answerTime,
                'viewed_explanation' => true,
            ]);
        }

        $this->showResult = true;
    }

    /**
     * 次の問題へ進む
     */
    public function nextQuestion()
    {
        if ($this->currentQuestionIndex < count($this->questions) - 1) {
            $this->currentQuestionIndex++;
            $this->selectedAnswer = null;
            $this->showResult = false;
            $this->isLastQuestion = $this->currentQuestionIndex === count($this->questions) - 1;

            // 新しい問題の回答開始時間を記録
            $this->answerStartTime = now();
        } else {
            // 試験終了時の処理
            $this->completeExamSession();

            // 最後の問題の場合は結果画面へ
            return redirect()->route('workbook.result', [
                'year' => $this->year,
                'score' => $this->score,
                'exam_id' => $this->examSession->id
            ]);
        }
    }

    /**
     * 前の問題に戻る
     */
    public function previousQuestion()
    {
        if ($this->currentQuestionIndex > 0) {
            $this->currentQuestionIndex--;

            // 前の問題の回答状態を復元
            if (isset($this->answers[$this->currentQuestionIndex])) {
                $this->selectedAnswer = $this->answers[$this->currentQuestionIndex]['selected'];
                $this->showResult = true;
            } else {
                $this->selectedAnswer = null;
                $this->showResult = false;
            }

            $this->isLastQuestion = false;
        }
    }

    /**
     * 試験セッションを完了する
     */
    private function completeExamSession()
    {
        if (!$this->examSession) {
            return;
        }

        // 正解数をカウント
        $correctCount = collect($this->answers)->filter(function ($answer) {
            return $answer['correct'];
        })->count();

        // 試験セッションを更新
        $this->examSession->update([
            'status' => 'completed',
            'total_points' => $this->score,
            'correct_answers' => $correctCount,
            'completed_at' => now(),
            'time_spent' => now()->diffInSeconds($this->startTime)
        ]);
    }

    public function render()
    {
        return view('livewire.workbook.year-questions', [
            'currentQuestion' => $this->questions[$this->currentQuestionIndex] ?? null,
        ]);
    }

    // サンプルデータ取得用のダミー関数（実際のアプリでは削除）
    private function getDummyQuestions()
    {
        return [
            [
                'id' => 1,
                'category' => 'アルゴリズム',
                'points' => 5,
                'question_text' => '<p>次のフローチャートの実行において、出力される値として正しいものを選びなさい。</p>
                <pre class="bg-gray-100 p-2 rounded mt-2 whitespace-pre-wrap overflow-x-auto max-w-full">
変数 x に 3 を代入する
変数 y に 5 を代入する
x > y ならば
    x に x + y を代入する
そうでなければ
    y に x + y を代入する
変数 z に x × y を代入する
z を出力する
</pre>',
                'image_path' => null,
                'choices' => [
                    'ア' => '24',
                    'イ' => '40',
                    'ウ' => '48',
                    'エ' => '64'
                ],
                'correct_answer' => 'ア',
                'explanation' => '<p>フローチャートを実行していきましょう。</p>
                <ol>
                    <li>変数 x に 3 を代入 → x = 3</li>
                    <li>変数 y に 5 を代入 → y = 5</li>
                    <li>x > y の条件判定 → 3 > 5 は偽</li>
                    <li>y に x + y を代入 → y = 3 + 5 = 8</li>
                    <li>z に x × y を代入 → z = 3 × 8 = 24</li>
                </ol>
                <p>したがって、出力される値は 24 です。</p>'
            ],
            // その他のダミー問題は省略...
        ];
    }
}
