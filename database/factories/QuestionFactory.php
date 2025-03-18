<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    // 日本語の質問タイトルのサンプル
    private $questionTemplates = [
        'アルゴリズム' => [
            '次のフローチャートの実行結果として正しいものを選びなさい。',
            '与えられた配列を昇順にソートするアルゴリズムとして適切なものを選びなさい。',
            '二分探索の計算量として正しいものを選びなさい。',
            '次の再帰関数の出力結果として正しいものを選びなさい。',
            '次のプログラムの時間計算量として正しいものを選びなさい。'
        ],
        'データベース' => [
            '次のSQLの実行結果として正しいものを選びなさい。',
            'データベースの正規化に関する記述で正しいものを選びなさい。',
            '次のER図に関する説明で適切なものを選びなさい。',
            'トランザクションの性質に関する記述で誤っているものを選びなさい。',
            'インデックスに関する説明として適切でないものを選びなさい。'
        ],
        'ネットワーク' => [
            'TCP/IPプロトコルに関する記述で正しいものを選びなさい。',
            'ルーティングプロトコルに関する説明として適切なものを選びなさい。',
            'HTTPステータスコードの説明として誤っているものを選びなさい。',
            'DNSの役割として適切な説明を選びなさい。',
            'サブネットマスクに関する記述で正しいものを選びなさい。'
        ],
        'セキュリティ' => [
            '公開鍵暗号方式に関する説明として正しいものを選びなさい。',
            'マルウェアに関する記述で適切でないものを選びなさい。',
            '情報セキュリティの三要素に関する説明として誤っているものを選びなさい。',
            'ファイアウォールの役割として最も適切な説明を選びなさい。',
            'ディジタル署名の目的として正しいものを選びなさい。'
        ],
        'プログラミング' => [
            '次のJavaコードの実行結果として正しいものを選びなさい。',
            '変数のスコープに関する説明として適切なものを選びなさい。',
            'オブジェクト指向プログラミングの特徴として誤っているものを選びなさい。',
            '次のPythonコードの出力結果として正しいものを選びなさい。',
            '例外処理に関する記述で適切でないものを選びなさい。'
        ],
        '情報システム' => [
            'ソフトウェア開発工程に関する説明として適切なものを選びなさい。',
            'システム要件定義に関する記述で正しいものを選びなさい。',
            'クラウドコンピューティングのサービスモデルに関する説明として誤っているものを選びなさい。',
            'システムの可用性を高める方法として適切でないものを選びなさい。',
            'ユーザビリティに関する記述で正しいものを選びなさい。'
        ]
    ];

    // 選択肢の接頭辞（日本語）
    private $choicePrefixes = ['ア', 'イ', 'ウ', 'エ'];

    /**
     * モデルのデフォルト状態を定義
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = array_keys($this->questionTemplates);
        $category = $this->faker->randomElement($categories);
        $years = [2022, 2023, 2024, 2025];

        // カテゴリに応じた質問文テンプレートからランダムに選択
        $questionText = '<p>' . $this->faker->randomElement($this->questionTemplates[$category]) . '</p>';

        // 選択肢の生成（日本語）
        $choices = [];
        $explanations = [
            'この選択肢は正しいです。理由は～～～のためです。',
            'この選択肢は誤りです。～～～が正しい説明です。',
            'この選択肢は不適切です。～～～の点で問題があります。',
            'この選択肢は部分的に正しいですが、～～～の点で不完全です。'
        ];

        foreach ($this->choicePrefixes as $index => $prefix) {
            $choices[$prefix] = $this->generateChoiceText($category);
        }

        $correctAnswer = $this->faker->randomElement($this->choicePrefixes);

        // タグの生成
        $tags = [$category];
        $subtags = $this->getSubtagsByCategory($category);
        for ($i = 0; $i < $this->faker->numberBetween(1, 3); $i++) {
            $tags[] = $this->faker->randomElement($subtags);
        }

        return [
            'year' => $this->faker->randomElement($years),
            'number' => $this->faker->numberBetween(1, 20),
            'category' => $category,
            'difficulty' => $this->faker->numberBetween(1, 5),
            'points' => $this->faker->randomElement([2, 3, 4, 5, 6]),
            'question_text' => $questionText,
            'image_path' => $this->faker->boolean(30) ? 'images/questions/' . $this->faker->word() . '.png' : null,
            'choices' => $choices,
            'correct_answer' => $correctAnswer,
            'explanation' => '<p>' . $this->generateExplanation($correctAnswer, $choices) . '</p>',
            'tags' => $tags,
            'is_active' => $this->faker->boolean(90),
        ];
    }

    /**
     * カテゴリに応じた選択肢テキストを生成
     */
    private function generateChoiceText($category): string
    {
        switch ($category) {
            case 'アルゴリズム':
                return $this->faker->randomElement([
                    'O(1)の計算量となる',
                    'O(n)の計算量となる',
                    'O(log n)の計算量となる',
                    'O(n log n)の計算量となる',
                    'O(n²)の計算量となる',
                    '最悪計算量が最小である',
                    '平均計算量が最小である',
                    '空間計算量が最小である',
                    'すべての要素を走査する必要がある',
                    '分割統治法を用いている'
                ]);
            case 'データベース':
                return $this->faker->randomElement([
                    '結合演算を行う',
                    '射影演算を行う',
                    '選択演算を行う',
                    '集約関数を使用する',
                    'インデックスを使用する',
                    'データの一貫性を保証する',
                    'トランザクションを適用する',
                    'リレーショナルモデルに基づいている',
                    '主キーと外部キーを持つ',
                    '正規化形式に従っている'
                ]);
            case 'ネットワーク':
                return $this->faker->randomElement([
                    'IPアドレスを割り当てる',
                    'データパケットを転送する',
                    'ルーティングテーブルを管理する',
                    'ドメイン名を解決する',
                    'プロトコルの変換を行う',
                    'セッションを確立する',
                    'ポート番号を指定する',
                    'ネットワークセキュリティを強化する',
                    'トラフィックを制御する',
                    'データの暗号化を行う'
                ]);
            case 'セキュリティ':
                return $this->faker->randomElement([
                    '暗号化アルゴリズムを使用する',
                    '認証機能を提供する',
                    'アクセス制御を実施する',
                    'ウイルス対策を行う',
                    'ファイアウォールを設定する',
                    'ディジタル署名を検証する',
                    'セキュリティポリシーを実装する',
                    '脆弱性を検出する',
                    'データの完全性を確保する',
                    'プライバシーを保護する'
                ]);
            case 'プログラミング':
                return $this->faker->randomElement([
                    '変数のスコープを定義する',
                    'クラスを継承する',
                    'インターフェースを実装する',
                    '例外処理を行う',
                    'メモリを動的に確保する',
                    'ガベージコレクションを適用する',
                    '再帰的に関数を呼び出す',
                    'オブジェクト指向設計を採用する',
                    '関数型プログラミングの概念を用いる',
                    'デザインパターンを適用する'
                ]);
            default:
                return $this->faker->sentence(5);
        }
    }

    /**
     * カテゴリに応じたサブタグを取得
     */
    private function getSubtagsByCategory($category): array
    {
        switch ($category) {
            case 'アルゴリズム':
                return ['ソート', '探索', '再帰', '計算量', 'データ構造', '分割統治法', '動的計画法', 'グラフアルゴリズム'];
            case 'データベース':
                return ['SQL', 'JOIN', '正規化', 'インデックス', 'トランザクション', 'ER図', 'ACID特性', 'クエリ最適化'];
            case 'ネットワーク':
                return ['TCP/IP', 'HTTP', 'DNS', 'ルーティング', 'サブネット', 'OSI参照モデル', 'Webサービス', 'プロトコル'];
            case 'セキュリティ':
                return ['暗号化', '認証', 'アクセス制御', 'マルウェア', 'ファイアウォール', 'ディジタル署名', 'ハッシュ関数', 'セキュリティポリシー'];
            case 'プログラミング':
                return ['変数', 'クラス', '継承', '例外処理', 'メモリ管理', 'オブジェクト指向', '関数型', 'デザインパターン'];
            case '情報システム':
                return ['要件定義', '設計', 'テスト', '保守', 'クラウド', 'サーバ', 'ユーザビリティ', 'アジャイル開発'];
            default:
                return ['基本概念', '応用', '実践', '理論'];
        }
    }

    /**
     * 解説文を生成
     */
    private function generateExplanation($correctAnswer, $choices): string
    {
        $explanation = "解答は「{$correctAnswer}」です。\n\n";

        foreach ($choices as $key => $choice) {
            if ($key === $correctAnswer) {
                $explanation .= "「{$key}」: {$choice} → この選択肢が正解です。";
                $explanation .= $this->faker->boolean ? "理由は、この方法が最も" . $this->faker->randomElement(['効率的', '正確', '一般的', '適切']) . "だからです。" : "";
            } else {
                $explanation .= "「{$key}」: {$choice} → この選択肢は" . $this->faker->randomElement(['誤りです', '適切ではありません', '不正確です']) . "。";
            }
            $explanation .= "\n\n";
        }

        return $explanation;
    }

    /**
     * アルゴリズム問題としてマーク
     */
    public function algorithm(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'category' => 'アルゴリズム',
                'tags' => array_merge($attributes['tags'] ?? [], ['アルゴリズム', '計算量', '効率性']),
            ];
        });
    }

    /**
     * データベース問題としてマーク
     */
    public function database(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'category' => 'データベース',
                'tags' => array_merge($attributes['tags'] ?? [], ['SQL', 'データベース', '正規化']),
            ];
        });
    }

    /**
     * ネットワーク問題としてマーク
     */
    public function network(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'category' => 'ネットワーク',
                'tags' => array_merge($attributes['tags'] ?? [], ['TCP/IP', 'プロトコル', 'ルーティング']),
            ];
        });
    }

    /**
     * 特定の年度を指定
     */
    public function ofYear(int $year): self
    {
        return $this->state(function () use ($year) {
            return [
                'year' => $year,
            ];
        });
    }

    /**
     * 特定の難易度を指定
     */
    public function difficulty(int $level): self
    {
        return $this->state(function () use ($level) {
            return [
                'difficulty' => $level,
            ];
        });
    }
}
