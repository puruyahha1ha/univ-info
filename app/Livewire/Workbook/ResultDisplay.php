<?php

namespace App\Livewire\Workbook;

use Livewire\Component;

class ResultDisplay extends Component
{
    public $year;
    public $score;
    public $answers;
    public $totalPoints = 0;
    public $totalQuestions = 0;
    public $correctCount = 0;
    public $correctPercentage = 0;
    public $timeSpent = '10分45秒'; // 実際には計測したものを使用
    public $averageTimePerQuestion = '32';
    public $weakestCategory = 'データベース';
    public $weakestCategoryPercentage = 33.3;
    public $categoryResults = [];
    public $questionResults = [];

    public function mount($year = null, $score = 0, $answers = null)
    {
        // パラメータにデフォルト値を設定し、nullや欠落時の対応を追加
        $this->year = $year ?? date('Y');
        $this->score = $score;

        // $answersが文字列として渡されることを想定
        if (is_string($answers) && !empty($answers)) {
            $this->answers = json_decode($answers, true) ?? [];
        } else {
            $this->answers = is_array($answers) ? $answers : [];
        }

        // 実際の問題データを取得
        $questions = $this->getQuestionData();
        $this->totalQuestions = count($questions);

        // 集計処理
        $this->processResults($questions);
    }

    private function processResults($questions)
    {
        $categoryStats = [];
        $this->weakestCategoryPercentage = 100; // 初期値として100%を設定し、より低い値で更新

        foreach ($questions as $index => $question) {
            $this->totalPoints += $question['points'];

            $answer = $this->answers[$index] ?? null;
            $isCorrect = $answer && isset($answer['correct']) && $answer['correct'] ? true : false;

            if ($isCorrect) {
                $this->correctCount++;
            }

            // カテゴリ集計
            $category = $question['category'];
            if (!isset($categoryStats[$category])) {
                $categoryStats[$category] = [
                    'total' => 0,
                    'correct' => 0,
                    'points' => 0
                ];
            }

            $categoryStats[$category]['total']++;
            if ($isCorrect) {
                $categoryStats[$category]['correct']++;
            }
            $categoryStats[$category]['points'] += $question['points'];

            // 問題別結果
            $selectedChoice = $answer ? ($answer['selected'] ?? '') : '';
            $this->questionResults[] = [
                'question' => strip_tags($question['question_text']),
                'category' => $question['category'],
                'points' => $question['points'],
                'correct' => $isCorrect,
                'selected' => $selectedChoice,
                'selectedText' => $question['choices'][$selectedChoice] ?? '',
                'correctAnswer' => $question['correct_answer'],
                'correctText' => $question['choices'][$question['correct_answer']] ?? '',
                'explanation' => strip_tags($question['explanation'])
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

            // 苦手カテゴリの判定（正答率が最も低いものを選定）
            if ($percentage < $this->weakestCategoryPercentage && $stats['total'] > 0) {
                $this->weakestCategory = $category;
                $this->weakestCategoryPercentage = $percentage;
            }
        }

        // 全体の正答率
        $this->correctPercentage = ($this->totalQuestions > 0) ? ($this->correctCount / $this->totalQuestions) * 100 : 0;
    }

    private function getQuestionData()
    {
        // 実際にはデータベースやファイルから取得する処理
        // ここではダミーデータを返す
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
