<?php

namespace App\Livewire\Workbook;

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

    public function mount($year)
    {
        $this->year = $year;
        $this->loadQuestions();
        $this->isLastQuestion = $this->currentQuestionIndex === count($this->questions) - 1;
    }

    public function loadQuestions()
    {
        // これは実際にはDBからデータを取得するか、別途ファイルから読み込むロジックに置き換えます
        $this->questions = $this->getDummyQuestions();
    }

    public function selectAnswer($key)
    {
        if ($this->showResult) {
            return;
        }

        $this->selectedAnswer = $key;
    }

    public function checkAnswer()
    {
        if (!$this->selectedAnswer) {
            return;
        }

        $currentQuestion = $this->questions[$this->currentQuestionIndex];
        $isCorrect = $this->selectedAnswer === $currentQuestion['correct_answer'];

        // 回答を記録
        $this->answers[$this->currentQuestionIndex] = [
            'selected' => $this->selectedAnswer,
            'correct' => $isCorrect,
        ];

        if ($isCorrect) {
            $this->score += $currentQuestion['points'];
        }

        $this->showResult = true;
    }

    public function nextQuestion()
    {
        if ($this->currentQuestionIndex < count($this->questions) - 1) {
            $this->currentQuestionIndex++;
            $this->selectedAnswer = null;
            $this->showResult = false;
            $this->isLastQuestion = $this->currentQuestionIndex === count($this->questions) - 1;
        } else {
            // 最後の問題の場合は結果画面へ
            return redirect()->route('workbook.result', [
                'year' => $this->year,
                'score' => $this->score,
                'answers' => json_encode($this->answers)
            ]);
        }
    }

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
                'image' => null,
                'choices' => [
                    'ア' => '24',
                    'イ' => '40',
                    'ウ' => '48',
                    'エ' => '64'
                ],
                'correct_answer' => 'ウ',
                'explanation' => '<p>フローチャートを実行していきましょう。</p>
                <ol>
                    <li>変数 x に 3 を代入 → x = 3</li>
                    <li>変数 y に 5 を代入 → y = 5</li>
                    <li>x > y の条件判定 → 3 > 5 は偽</li>
                    <li>y に x + y を代入 → y = 3 + 5 = 8</li>
                    <li>z に x × y を代入 → z = 3 × 8 = 24</li>
                </ol>
                <p>したがって、出力される値は 24 です。</p>
                <p>正解は「ア」です。</p>'
            ],
            [
                'id' => 2,
                'category' => 'データベース',
                'points' => 6,
                'question_text' => '<p>次のような2つの表があります。</p>
                <p><strong>商品表</strong></p>
                <table class="border-collapse border border-gray-300 w-full">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2">商品ID</th>
                            <th class="border border-gray-300 px-4 py-2">商品名</th>
                            <th class="border border-gray-300 px-4 py-2">価格</th>
                            <th class="border border-gray-300 px-4 py-2">カテゴリID</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">1</td>
                            <td class="border border-gray-300 px-4 py-2">ノートPC</td>
                            <td class="border border-gray-300 px-4 py-2">80000</td>
                            <td class="border border-gray-300 px-4 py-2">1</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">2</td>
                            <td class="border border-gray-300 px-4 py-2">タブレット</td>
                            <td class="border border-gray-300 px-4 py-2">50000</td>
                            <td class="border border-gray-300 px-4 py-2">1</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">3</td>
                            <td class="border border-gray-300 px-4 py-2">スマートフォン</td>
                            <td class="border border-gray-300 px-4 py-2">60000</td>
                            <td class="border border-gray-300 px-4 py-2">2</td>
                        </tr>
                    </tbody>
                </table>
                
                <p><strong>カテゴリ表</strong></p>
                <table class="border-collapse border border-gray-300 w-full mt-4">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2">カテゴリID</th>
                            <th class="border border-gray-300 px-4 py-2">カテゴリ名</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">1</td>
                            <td class="border border-gray-300 px-4 py-2">コンピュータ</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">2</td>
                            <td class="border border-gray-300 px-4 py-2">モバイル</td>
                        </tr>
                    </tbody>
                </table>
                
                <p class="mt-4">次のSQL文を実行した結果として正しいものを選びなさい。</p>
                <pre class="bg-gray-100 p-2 rounded mt-2 whitespace-pre-wrap overflow-x-auto max-w-full">
SELECT 商品名, カテゴリ名 
FROM 商品表 
JOIN カテゴリ表 ON 商品表.カテゴリID = カテゴリ表.カテゴリID 
WHERE 価格 > 60000;
</pre>',
                'image' => null,
                'choices' => [
                    'ア' => 'ノートPC, コンピュータ',
                    'イ' => 'ノートPC, コンピュータ<br>タブレット, コンピュータ',
                    'ウ' => 'タブレット, コンピュータ<br>スマートフォン, モバイル',
                    'エ' => 'ノートPC, コンピュータ<br>スマートフォン, モバイル'
                ],
                'correct_answer' => 'ア',
                'explanation' => '<p>SQLの実行結果を確認していきましょう。</p>
                <p>SQL文では、商品表とカテゴリ表を結合し、価格が60000より大きい商品の商品名とカテゴリ名を選択しています。</p>
                <p>価格が60000より大きい商品は「ノートPC（80000円）」のみです。したがって、結果は「ノートPC, コンピュータ」のみとなります。</p>
                <p>正解は「ア」です。</p>'
            ],
            [
                'id' => 3,
                'category' => 'ネットワーク',
                'points' => 4,
                'question_text' => '<p>コンピュータネットワークに関する次の記述のうち、正しいものを選びなさい。</p>',
                'image' => null,
                'choices' => [
                    'ア' => 'IPアドレスは、インターネット上の各機器を識別するための32ビットまたは128ビットの番号である。',
                    'イ' => 'HTTPは、電子メールの送受信に使用されるプロトコルである。',
                    'ウ' => 'DNSは、ファイル転送に特化したプロトコルである。',
                    'エ' => 'SSLは、データ圧縮のための標準規格である。'
                ],
                'correct_answer' => 'ア',
                'explanation' => '<p>各選択肢を確認していきましょう：</p>
                <ul>
                    <li>ア：IPアドレスはインターネット上の機器を識別するための番号で、IPv4では32ビット、IPv6では128ビットを使用します。これは正しい記述です。</li>
                    <li>イ：HTTPはウェブページの閲覧に使用されるプロトコルです。電子メールの送受信には主にSMTPやPOP3、IMAPなどが使用されます。</li>
                    <li>ウ：DNSはドメイン名とIPアドレスの変換を行うシステムです。ファイル転送に特化したプロトコルはFTPです。</li>
                    <li>エ：SSLはセキュアソケットレイヤーの略で、通信の暗号化を行うプロトコルです。データ圧縮の標準規格ではありません。</li>
                </ul>
                <p>したがって、正しい記述は「ア」です。</p>'
            ]
        ];
    }
}
