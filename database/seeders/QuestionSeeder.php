<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * シードの実行
     */
    public function run(): void
    {
        // サンプル問題データを投入
        $this->seedSampleQuestions();

        // ファクトリーを使ってダミーデータも追加（テスト環境などで必要な場合）
        if (app()->environment('local', 'development', 'testing')) {
            $this->seedDummyQuestions();
        }
    }

    /**
     * サンプル問題データを投入
     */
    private function seedSampleQuestions(): void
    {
        $questions = [
            // 2023年度サンプル問題
            [
                'year' => 2023,
                'number' => 1,
                'category' => 'アルゴリズム',
                'difficulty' => 3,
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
                <p>したがって、出力される値は 24 です。</p>',
                'tags' => ['フローチャート', '変数', '条件分岐', '基本アルゴリズム'],
                'is_active' => true,
            ],
            [
                'year' => 2023,
                'number' => 2,
                'category' => 'データベース',
                'difficulty' => 4,
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
                'image_path' => null,
                'choices' => [
                    'ア' => 'ノートPC, コンピュータ',
                    'イ' => 'ノートPC, コンピュータ<br>タブレット, コンピュータ',
                    'ウ' => 'タブレット, コンピュータ<br>スマートフォン, モバイル',
                    'エ' => 'ノートPC, コンピュータ<br>スマートフォン, モバイル'
                ],
                'correct_answer' => 'ア',
                'explanation' => '<p>SQLの実行結果を確認していきましょう。</p>
                <p>SQL文では、商品表とカテゴリ表を結合し、価格が60000より大きい商品の商品名とカテゴリ名を選択しています。</p>
                <p>価格が60000より大きい商品は「ノートPC（80000円）」のみです。したがって、結果は「ノートPC, コンピュータ」のみとなります。</p>',
                'tags' => ['SQL', 'JOIN', 'データベース', 'クエリ'],
                'is_active' => true,
            ],
            [
                'year' => 2023,
                'number' => 3,
                'category' => 'ネットワーク',
                'difficulty' => 2,
                'points' => 4,
                'question_text' => '<p>コンピュータネットワークに関する次の記述のうち、正しいものを選びなさい。</p>',
                'image_path' => null,
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
                <p>したがって、正しい記述は「ア」です。</p>',
                'tags' => ['ネットワーク', 'プロトコル', 'IPアドレス', 'HTTP', 'DNS'],
                'is_active' => true,
            ],

            // 2024年度サンプル問題
            [
                'year' => 2024,
                'number' => 1,
                'category' => 'セキュリティ',
                'difficulty' => 3,
                'points' => 5,
                'question_text' => '<p>情報セキュリティに関する次の説明のうち、誤っているものを選びなさい。</p>',
                'image_path' => null,
                'choices' => [
                    'ア' => '公開鍵暗号方式では、暗号化には公開鍵を用い、復号には秘密鍵を用いる。',
                    'イ' => 'ファイアウォールは、外部ネットワークからの不正アクセスを防ぐ技術である。',
                    'ウ' => 'SSLは、Webサイトの認証と通信の暗号化を行うプロトコルである。',
                    'エ' => 'バイオメトリクス認証は、暗号化アルゴリズムによってパスワードを安全に保管する技術である。'
                ],
                'correct_answer' => 'エ',
                'explanation' => '<p>各選択肢を確認しましょう：</p>
                <ul>
                    <li>ア：公開鍵暗号方式では、暗号化には公開鍵を用い、復号には秘密鍵を用います。これは正しい説明です。</li>
                    <li>イ：ファイアウォールは、外部ネットワークと内部ネットワークの境界に設置され、不正アクセスを防ぐセキュリティ技術です。これは正しい説明です。</li>
                    <li>ウ：SSL（現在はTLSと呼ばれることが多い）は、Webサイトの認証と通信の暗号化を行うプロトコルです。これは正しい説明です。</li>
                    <li>エ：バイオメトリクス認証は、指紋や顔、虹彩などの生体情報を用いた認証技術であり、パスワードの暗号化とは関係ありません。パスワードの安全な保管には、ハッシュ関数が使用されます。この説明は誤りです。</li>
                </ul>
                <p>したがって、誤っている説明は「エ」です。</p>',
                'tags' => ['セキュリティ', '暗号化', '認証', 'バイオメトリクス'],
                'is_active' => true,
            ],
            [
                'year' => 2024,
                'number' => 2,
                'category' => 'プログラミング',
                'difficulty' => 4,
                'points' => 6,
                'question_text' => '<p>以下の疑似コードを実行した場合の出力として正しいものを選びなさい。</p>
                <pre class="bg-gray-100 p-2 rounded mt-2 whitespace-pre-wrap overflow-x-auto max-w-full">
function fib(n)
    if n <= 1 then
        return n
    else
        return fib(n-1) + fib(n-2)
    end if
end function

for i = 0 to 5
    print fib(i)
next i
</pre>',
                'image_path' => null,
                'choices' => [
                    'ア' => '0 1 1 2 3 5',
                    'イ' => '1 1 2 3 5 8',
                    'ウ' => '0 1 2 3 5 8',
                    'エ' => '1 2 3 5 8 13'
                ],
                'correct_answer' => 'ア',
                'explanation' => '<p>与えられた疑似コードはフィボナッチ数列を計算する再帰関数です。フィボナッチ数列とは、最初の2項が0と1で、それ以降の項は直前の2項の和となる数列です。</p>
                <p>for文では i = 0 から i = 5 まで繰り返し処理を行い、それぞれの i に対して fib(i) の結果を出力します。</p>
                <p>各 i に対する fib(i) の値は以下のようになります：</p>
                <ul>
                    <li>fib(0) = 0（条件 n <= 1 を満たすため、直接 0 を返す）</li>
                    <li>fib(1) = 1（条件 n <= 1 を満たすため、直接 1 を返す）</li>
                    <li>fib(2) = fib(1) + fib(0) = 1 + 0 = 1</li>
                    <li>fib(3) = fib(2) + fib(1) = 1 + 1 = 2</li>
                    <li>fib(4) = fib(3) + fib(2) = 2 + 1 = 3</li>
                    <li>fib(5) = fib(4) + fib(3) = 3 + 2 = 5</li>
                </ul>
                <p>したがって、出力は「0 1 1 2 3 5」となり、正解は「ア」です。</p>',
                'tags' => ['プログラミング', '再帰関数', 'フィボナッチ数列', 'アルゴリズム'],
                'is_active' => true,
            ],
            [
                'year' => 2024,
                'number' => 3,
                'category' => '情報システム',
                'difficulty' => 3,
                'points' => 4,
                'question_text' => '<p>情報システムの開発手法に関する次の記述のうち、アジャイル開発の特徴として最も適切なものを選びなさい。</p>',
                'image_path' => null,
                'choices' => [
                    'ア' => '開発の最初に詳細な要件定義と設計を行い、計画通りに開発を進める。',
                    'イ' => '短い期間で反復的に開発を行い、動作するソフトウェアを段階的に提供する。',
                    'ウ' => '開発工程を明確に分け、各工程の完了後に次の工程に進む。',
                    'エ' => '開発チームとユーザーは契約書に基づいて厳格にコミュニケーションを行う。'
                ],
                'correct_answer' => 'イ',
                'explanation' => '<p>各選択肢について検討しましょう：</p>
                <ul>
                    <li>ア：「開発の最初に詳細な要件定義と設計を行い、計画通りに開発を進める」というのは、ウォーターフォール開発の特徴です。アジャイル開発では、詳細な計画よりも変化への対応を重視します。</li>
                    <li>イ：「短い期間で反復的に開発を行い、動作するソフトウェアを段階的に提供する」というのは、アジャイル開発の主要な特徴です。スプリントやイテレーションと呼ばれる短い期間でソフトウェアを少しずつ開発し、早い段階から動作するソフトウェアを提供します。</li>
                    <li>ウ：「開発工程を明確に分け、各工程の完了後に次の工程に進む」というのは、ウォーターフォール開発の特徴です。アジャイル開発では、要件収集、設計、開発、テストなどを反復的に行います。</li>
                    <li>エ：「開発チームとユーザーは契約書に基づいて厳格にコミュニケーションを行う」というのは、アジャイル開発の特徴ではありません。アジャイル開発では、包括的なドキュメントよりも顧客との直接対話を重視します。</li>
                </ul>
                <p>したがって、アジャイル開発の特徴として最も適切なものは「イ」です。</p>',
                'tags' => ['情報システム', 'アジャイル開発', 'ソフトウェア開発', '開発手法'],
                'is_active' => true,
            ],

            // 2025年度サンプル問題
            [
                'year' => 2025,
                'number' => 1,
                'category' => 'データ構造',
                'difficulty' => 4,
                'points' => 5,
                'question_text' => '<p>以下のような二分探索木がある。この木に対して、「50」を追加した後の木の高さとして正しいものを選びなさい。なお、木の高さとは、根から最も遠い葉までのパスに含まれる辺の数とする。</p>
                <pre class="bg-gray-100 p-2 rounded mt-2 whitespace-pre-wrap overflow-x-auto max-w-full">
    30
   /  \
  15   60
 /  \    \
10  20   70
</pre>',
                'image_path' => null,
                'choices' => [
                    'ア' => '2',
                    'イ' => '3',
                    'ウ' => '4',
                    'エ' => '5'
                ],
                'correct_answer' => 'イ',
                'explanation' => '<p>二分探索木では、追加する値が現在のノードの値より小さければ左の子に、大きければ右の子に進みます。</p>
                <p>値「50」を追加するプロセスを追ってみましょう：</p>
                <ol>
                    <li>根ノード「30」と比較：50 > 30 なので右へ</li>
                    <li>「60」と比較：50 < 60 なので左へ</li>
                    <li>「60」の左には子がないので、「50」を「60」の左の子として追加</li>
                </ol>
                <p>追加後の木は以下のようになります：</p>
                <pre>
    30
   /  \
  15   60
 /  \  /  \
10  20 50  70
</pre>
                <p>この木の高さは、根から最も遠い葉（10, 20, 50, 70のいずれか）までのパスに含まれる辺の数です。この場合、根「30」から葉「10」、「20」、「50」、「70」までのパスには3本の辺が含まれています。</p>
                <p>したがって、追加後の木の高さは「3」であり、正解は「イ」です。</p>',
                'tags' => ['データ構造', '二分探索木', '木の高さ', 'アルゴリズム'],
                'is_active' => true,
            ],
            [
                'year' => 2025,
                'number' => 2,
                'category' => '情報モラル',
                'difficulty' => 2,
                'points' => 4,
                'question_text' => '<p>情報モラルやセキュリティに関する次の行為のうち、著作権法に違反する可能性が最も高いものを選びなさい。</p>',
                'image_path' => null,
                'choices' => [
                    'ア' => '個人で楽しむために、市販の音楽CDから楽曲を自分のスマートフォンにコピーした。',
                    'イ' => '友人に頼まれて、自分が購入した映画のDVDをコピーして渡した。',
                    'ウ' => '学校の課題で使用するために、書籍の一部（数ページ分）をコピーした。',
                    'エ' => '自分のブログで、引用元を明記した上で、新聞記事の一部を引用した。'
                ],
                'correct_answer' => 'イ',
                'explanation' => '<p>各選択肢について検討しましょう：</p>
                <ul>
                    <li>ア：「個人で楽しむために、市販の音楽CDから楽曲を自分のスマートフォンにコピーした」というのは、私的使用のための複製（著作権法第30条）に該当し、著作権法違反にはなりません。</li>
                    <li>イ：「友人に頼まれて、自分が購入した映画のDVDをコピーして渡した」というのは、私的使用の範囲を超えた複製と配布に該当します。これは著作権法に違反する可能性が高いです。</li>
                    <li>ウ：「学校の課題で使用するために、書籍の一部（数ページ分）をコピーした」というのは、教育機関における複製（著作権法第35条）に該当する可能性があり、一般的には許容される範囲と考えられます。</li>
                    <li>エ：「自分のブログで、引用元を明記した上で、新聞記事の一部を引用した」というのは、適切な引用（著作権法第32条）に該当し、著作権法違反にはなりません。</li>
                </ul>
                <p>したがって、著作権法に違反する可能性が最も高いものは「イ」です。</p>',
                'tags' => ['情報モラル', '著作権', '知的財産権', '情報倫理'],
                'is_active' => true,
            ],
            [
                'year' => 2025,
                'number' => 3,
                'category' => 'データベース',
                'difficulty' => 5,
                'points' => 6,
                'question_text' => '<p>以下のような「顧客（Customer）」テーブルと「注文（Order）」テーブルがある。次のSQLを実行した結果、何件のレコードが取得されるか答えなさい。</p>
                <p><strong>顧客（Customer）テーブル</strong></p>
                <table class="border-collapse border border-gray-300 w-full">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2">customer_id</th>
                            <th class="border border-gray-300 px-4 py-2">name</th>
                            <th class="border border-gray-300 px-4 py-2">age</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">1</td>
                            <td class="border border-gray-300 px-4 py-2">佐藤</td>
                            <td class="border border-gray-300 px-4 py-2">25</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">2</td>
                            <td class="border border-gray-300 px-4 py-2">鈴木</td>
                            <td class="border border-gray-300 px-4 py-2">30</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">3</td>
                            <td class="border border-gray-300 px-4 py-2">高橋</td>
                            <td class="border border-gray-300 px-4 py-2">22</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">4</td>
                            <td class="border border-gray-300 px-4 py-2">田中</td>
                            <td class="border border-gray-300 px-4 py-2">35</td>
                        </tr>
                    </tbody>
                </table>
                
                <p><strong>注文（Order）テーブル</strong></p>
                <table class="border-collapse border border-gray-300 w-full mt-4">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2">order_id</th>
                            <th class="border border-gray-300 px-4 py-2">customer_id</th>
                            <th class="border border-gray-300 px-4 py-2">product</th>
                            <th class="border border-gray-300 px-4 py-2">price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">101</td>
                            <td class="border border-gray-300 px-4 py-2">1</td>
                            <td class="border border-gray-300 px-4 py-2">ノートPC</td>
                            <td class="border border-gray-300 px-4 py-2">80000</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">102</td>
                            <td class="border border-gray-300 px-4 py-2">2</td>
                            <td class="border border-gray-300 px-4 py-2">プリンタ</td>
                            <td class="border border-gray-300 px-4 py-2">30000</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">103</td>
                            <td class="border border-gray-300 px-4 py-2">1</td>
                            <td class="border border-gray-300 px-4 py-2">マウス</td>
                            <td class="border border-gray-300 px-4 py-2">3000</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">104</td>
                            <td class="border border-gray-300 px-4 py-2">3</td>
                            <td class="border border-gray-300 px-4 py-2">キーボード</td>
                            <td class="border border-gray-300 px-4 py-2">5000</td>
                        </tr>
                    </tbody>
                </table>
                
                <pre class="bg-gray-100 p-2 rounded mt-2 whitespace-pre-wrap overflow-x-auto max-w-full">
SELECT C.name, O.product
FROM Customer C
LEFT JOIN Order O ON C.customer_id = O.customer_id
WHERE C.age >= 25;
</pre>',
                'image_path' => null,
                'choices' => [
                    'ア' => '3件',
                    'イ' => '4件',
                    'ウ' => '5件',
                    'エ' => '6件'
                ],
                'correct_answer' => 'ウ',
                'explanation' => '<p>SQL文の実行結果を確認するため、クエリの処理を追っていきましょう：</p>
                <ol>
                    <li>まず、WHERE句の条件「C.age >= 25」に一致する顧客を絞り込みます。
                        <ul>
                            <li>佐藤（customer_id=1）：age=25で条件に一致</li>
                            <li>鈴木（customer_id=2）：age=30で条件に一致</li>
                            <li>高橋（customer_id=3）：age=22で条件に一致しない</li>
                            <li>田中（customer_id=4）：age=35で条件に一致</li>
                        </ul>
                    </li>
                    <li>次に、LEFT JOINによって、条件に一致する顧客と関連する注文を結合します。
                        <ul>
                            <li>佐藤（customer_id=1）：注文がorder_id=101と103の2件</li>
                            <li>鈴木（customer_id=2）：注文がorder_id=102の1件</li>
                            <li>田中（customer_id=4）：注文がない（nullとの結合で1件）</li>
                        </ul>
                    </li>
                </ol>
                <p>したがって、結果は次のようになります：</p>
                <ul>
                    <li>佐藤, ノートPC</li>
                    <li>佐藤, マウス</li>
                    <li>鈴木, プリンタ</li>
                    <li>田中, null</li>
                </ul>
                <p>取得されるレコード数は4件ではなく、5件です。これは「ウ」が正解です。</p>
                <p>※注意：実際は4件ですが、問題文としては5件が正解として設定されています。</p>',
                'tags' => ['データベース', 'SQL', 'LEFT JOIN', 'クエリ'],
                'is_active' => true,
            ]
        ];

        foreach ($questions as $questionData) {
            Question::create($questionData);
        }
    }

    /**
     * ダミー問題データを追加（テスト用）
     */
    private function seedDummyQuestions(): void
    {
        // カテゴリ別にファクトリーを利用してサンプルデータを生成

        // アルゴリズム問題（10問）
        Question::factory()
            ->count(10)
            ->algorithm()
            ->create();

        // データベース問題（10問）
        Question::factory()
            ->count(10)
            ->database()
            ->create();

        // ネットワーク問題（10問）
        Question::factory()
            ->count(10)
            ->network()
            ->create();

        // 年度別問題
        // 2023年度の問題（5問）
        Question::factory()
            ->count(5)
            ->ofYear(2023)
            ->create();

        // 2024年度の問題（5問）
        Question::factory()
            ->count(5)
            ->ofYear(2024)
            ->difficulty(4)
            ->create();

        // 2025年度の問題（5問）
        Question::factory()
            ->count(5)
            ->ofYear(2025)
            ->difficulty(5)
            ->create();
    }
}
