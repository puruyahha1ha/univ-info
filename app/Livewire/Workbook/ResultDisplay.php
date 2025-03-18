<?php

namespace App\Livewire\Workbook;

use App\Models\ExamSession;
use App\Models\Question;
use App\Models\UserAnswer;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ResultDisplay extends Component
{
    public $year;
    public $score;
    public $exam_id;
    public $totalPoints = 0;
    public $totalQuestions = 0;
    public $correctCount = 0;
    public $correctPercentage = 0;
    public $timeSpent = '';
    public $averageTimePerQuestion = '';
    public $weakestCategory = '';
    public $weakestCategoryPercentage = 100;
    public $categoryResults = [];
    public $questionResults = [];
    public $examSession = null;

    public function mount($year = null, $score = 0, $exam_id = null)
    {
        $this->year = $year ?? date('Y');
        $this->score = $score;
        $this->exam_id = $exam_id;

        // 試験セッションを取得
        $this->loadExamSession();

        // 結果データを処理
        $this->processResults();
    }

    /**
     * 試験セッションデータをロード
     */
    private function loadExamSession()
    {
        if ($this->exam_id) {
            // データベースから特定の試験セッションを取得
            $this->examSession = ExamSession::with('questions', 'userAnswers')->find($this->exam_id);

            if ($this->examSession) {
                $this->year = $this->examSession->year;
                $this->score = $this->examSession->total_points;
                $this->totalPoints = $this->examSession->max_points;
                $this->totalQuestions = $this->examSession->total_questions;
                $this->correctCount = $this->examSession->correct_answers;
                $this->timeSpent = $this->examSession->formatted_time_spent;

                // 平均回答時間を計算
                if ($this->totalQuestions > 0 && $this->examSession->time_spent > 0) {
                    $avgSeconds = round($this->examSession->time_spent / $this->totalQuestions);
                    $this->averageTimePerQuestion = $avgSeconds . '秒';
                } else {
                    $this->averageTimePerQuestion = 'N/A';
                }
            }
        }

        // 試験セッションが見つからない場合、仮のデータを設定
        if (!$this->examSession) {
            $this->timeSpent = '10分45秒';
            $this->averageTimePerQuestion = '32秒';
        }
    }

    /**
     * 結果データを処理
     */
    private function processResults()
    {
        // カテゴリごとの統計を初期化
        $categoryStats = [];

        if ($this->examSession) {
            // 試験セッションが存在する場合、そのデータを使用

            // 問題と回答のデータを取得
            $questions = $this->examSession->questions;
            $userAnswers = $this->examSession->userAnswers;

            // カテゴリごとの統計を計算
            foreach ($questions as $question) {
                $category = $question->category;

                if (!isset($categoryStats[$category])) {
                    $categoryStats[$category] = [
                        'total' => 0,
                        'correct' => 0,
                        'points' => 0
                    ];
                }

                $categoryStats[$category]['total']++;

                // この問題に対するユーザーの回答を検索
                $answer = $userAnswers->where('question_id', $question->id)->first();

                if ($answer && $answer->is_correct) {
                    $categoryStats[$category]['correct']++;
                    $categoryStats[$category]['points'] += $answer->points_earned;
                }

                // 問題別結果を構築
                $this->questionResults[] = [
                    'question' => strip_tags($question->question_text),
                    'category' => $question->category,
                    'points' => $question->points,
                    'correct' => $answer ? $answer->is_correct : false,
                    'selected' => $answer ? $answer->selected_answer : '',
                    'selectedText' => $answer ? ($question->choices[$answer->selected_answer] ?? '') : '',
                    'correctAnswer' => $question->correct_answer,
                    'correctText' => $question->choices[$question->correct_answer] ?? '',
                    'explanation' => strip_tags($question->explanation),
                    'answerTime' => $answer ? $answer->answer_time : 0
                ];
            }
        } else {
            // 試験セッションが存在しない場合、仮のデータを使用
            $questions = Question::where('year', $this->year)->get();

            if ($questions->isEmpty()) {
                // 問題が見つからない場合はダミーデータを使用
                $questions = $this->getDummyQuestions();
                $this->processResultsFromDummyData($questions);
                return;
            }

            // 問題別の結果を仮定
            $this->totalQuestions = $questions->count();

            foreach ($questions as $index => $question) {
                $category = $question->category;
                $isCorrect = rand(0, 1) === 1; // ランダムな正誤

                if (!isset($categoryStats[$category])) {
                    $categoryStats[$category] = [
                        'total' => 0,
                        'correct' => 0,
                        'points' => 0
                    ];
                }

                $categoryStats[$category]['total']++;

                if ($isCorrect) {
                    $this->correctCount++;
                    $categoryStats[$category]['correct']++;
                    $categoryStats[$category]['points'] += $question->points;
                }

                $this->totalPoints += $question->points;

                // 問題別結果を構築
                $randomAnswer = array_rand($question->choices);
                $this->questionResults[] = [
                    'question' => strip_tags($question->question_text),
                    'category' => $question->category,
                    'points' => $question->points,
                    'correct' => $isCorrect,
                    'selected' => $isCorrect ? $question->correct_answer : $randomAnswer,
                    'selectedText' => $isCorrect ? ($question->choices[$question->correct_answer] ?? '') : ($question->choices[$randomAnswer] ?? ''),
                    'correctAnswer' => $question->correct_answer,
                    'correctText' => $question->choices[$question->correct_answer] ?? '',
                    'explanation' => strip_tags($question->explanation),
                    'answerTime' => rand(10, 60)
                ];
            }
        }

        // カテゴリ別統計処理
        foreach ($categoryStats as $category => $stats) {
            $percentage = ($stats['total'] > 0) ? ($stats['correct'] / $stats['total']) * 100 : 0;
            $this->categoryResults[$category] = [
                'total' => $stats['total'],
                'correct' => $stats['correct'],
                'percentage' => $percentage,
                'points' => $stats['points']
            ];

            // 苦手カテゴリの判定（正答率が最も低いものを選定）
            if ($percentage < $this->weakestCategoryPercentage && $stats['total'] > 0) {
                $this->weakestCategory = $category;
                $this->weakestCategoryPercentage = $percentage;
            }
        }

        // 全体の正答率
        $this->correctPercentage = ($this->totalQuestions > 0) ? ($this->correctCount / $this->totalQuestions) * 100 : 0;
    }

    /**
     * ダミーデータから結果を処理（試験セッションが存在しない場合）
     */
    private function processResultsFromDummyData($questions)
    {
        $categoryStats = [];
        $this->totalQuestions = count($questions);

        foreach ($questions as $index => $question) {
            $category = $question['category'];
            $isCorrect = rand(0, 1) === 1; // ランダムな正誤

            if (!isset($categoryStats[$category])) {
                $categoryStats[$category] = [
                    'total' => 0,
                    'correct' => 0,
                    'points' => 0
                ];
            }

            $categoryStats[$category]['total']++;

            if ($isCorrect) {
                $this->correctCount++;
                $categoryStats[$category]['correct']++;
                $categoryStats[$category]['points'] += $question['points'];
            }

            $this->totalPoints += $question['points'];

            // 問題別結果を構築
            $randomAnswer = array_rand($question['choices']);
            $this->questionResults[] = [
                'question' => strip_tags($question['question_text']),
                'category' => $question['category'],
                'points' => $question['points'],
                'correct' => $isCorrect,
                'selected' => $isCorrect ? $question['correct_answer'] : $randomAnswer,
                'selectedText' => $isCorrect ? ($question['choices'][$question['correct_answer']] ?? '') : ($question['choices'][$randomAnswer] ?? ''),
                'correctAnswer' => $question['correct_answer'],
                'correctText' => $question['choices'][$question['correct_answer']] ?? '',
                'explanation' => strip_tags($question['explanation']),
                'answerTime' => rand(10, 60)
            ];
        }

        // カテゴリ別統計処理
        foreach ($categoryStats as $category => $stats) {
            $percentage = ($stats['total'] > 0) ? ($stats['correct'] / $stats['total']) * 100 : 0;
            $this->categoryResults[$category] = [
                'total' => $stats['total'],
                'correct' => $stats['correct'],
                'percentage' => $percentage,
                'points' => $stats['points']
            ];

            // 苦手カテゴリの判定
            if ($percentage < $this->weakestCategoryPercentage && $stats['total'] > 0) {
                $this->weakestCategory = $category;
                $this->weakestCategoryPercentage = $percentage;
            }
        }

        // 全体の正答率
        $this->correctPercentage = ($this->totalQuestions > 0) ? ($this->correctCount / $this->totalQuestions) * 100 : 0;
    }

    /**
     * ダミーの問題データを返す
     */
    private function getDummyQuestions()
    {
        return [
            [
                'id' => 1,
                'category' => 'アルゴリズム',
                'points' => 5,
                'question_text' => 'フローチャートの実行において、出力される値として正しいものを選びなさい。',
                'choices' => [
                    'ア' => '24',
                    'イ' => '40',
                    'ウ' => '48',
                    'エ' => '64'
                ],
                'correct_answer' => 'ア',
                'explanation' => 'フローチャートの実行過程では、x=3, y=5 で条件分岐後に y=8 となり、z=3*8=24 になります。'
            ],
            [
                'id' => 2,
                'category' => 'データベース',
                'points' => 6,
                'question_text' => '商品表とカテゴリ表を結合して価格が60000より大きい商品を抽出するSQL文の結果として正しいものを選びなさい。',
                'choices' => [
                    'ア' => 'ノートPC, コンピュータ',
                    'イ' => 'ノートPC, コンピュータ タブレット, コンピュータ',
                    'ウ' => 'タブレット, コンピュータ スマートフォン, モバイル',
                    'エ' => 'ノートPC, コンピュータ スマートフォン, モバイル'
                ],
                'correct_answer' => 'ア',
                'explanation' => '価格が60000より大きい商品は「ノートPC（80000円）」のみであり、そのカテゴリは「コンピュータ」です。'
            ],
            [
                'id' => 3,
                'category' => 'ネットワーク',
                'points' => 4,
                'question_text' => 'コンピュータネットワークに関する次の記述のうち、正しいものを選びなさい。',
                'choices' => [
                    'ア' => 'IPアドレスは、インターネット上の各機器を識別するための32ビットまたは128ビットの番号である。',
                    'イ' => 'HTTPは、電子メールの送受信に使用されるプロトコルである。',
                    'ウ' => 'DNSは、ファイル転送に特化したプロトコルである。',
                    'エ' => 'SSLは、データ圧縮のための標準規格である。'
                ],
                'correct_answer' => 'ア',
                'explanation' => 'IPアドレスはインターネット上の機器を識別するための番号で、IPv4では32ビット、IPv6では128ビットを使用します。'
            ],
        ];
    }

    public function render()
    {
        return view('livewire.workbook.result-display');
    }
}
