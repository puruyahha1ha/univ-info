<div>
    <!-- ヒーローセクション -->
    <section class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-16 px-4">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-3xl md:text-5xl font-bold mb-4">共通テスト「情報Ⅰ」対策</h1>
            <p class="text-lg md:text-xl mb-8">
                スケジュール管理から過去問対策まで、あなたの合格を全力でサポートします
            </p>
            <div class="space-x-4">
                <a href="{{ route('register') }}"
                    class="inline-block bg-yellow-400 text-blue-900 font-semibold px-6 py-3 rounded shadow hover:bg-yellow-300 transition-colors">
                    無料会員登録
                </a>
                <a href="{{ route('login') }}"
                    class="inline-block bg-white text-blue-800 font-semibold px-6 py-3 rounded shadow hover:bg-gray-100 transition-colors" wire:navigate>
                    ログイン
                </a>
            </div>
        </div>
    </section>

    <!-- サイトの特徴 -->
    <section class="py-12 px-4">
        <div class="max-w-7xl mx-auto text-center mb-12">
            <h2 class="text-2xl md:text-3xl font-bold">サイトの特徴</h2>
            <p class="text-gray-600 mt-2">効率的に合格を目指すための充実した機能をご用意</p>
        </div>
        <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- 特徴1 -->
            <div class="bg-white rounded shadow p-6">
                <div class="mb-4 flex justify-center text-blue-600">
                    <!-- アイコン例 -->
                    <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 2C7.03 2 3 6.03 3 11c0 4.97 4.03 9 9 9s9-4.03 9-9c0-4.97-4.03-9-9-9zm3 13H9v-2h6v2zm2-4H7V9h10v2z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">豊富な入試情報</h3>
                <p class="text-gray-600">
                    最新の入試情報を随時更新。大学の詳細情報や受験科目などを簡単に確認できます。
                </p>
            </div>
            <!-- 特徴2 -->
            <div class="bg-white rounded shadow p-6">
                <div class="mb-4 flex justify-center text-blue-600">
                    <!-- アイコン例 -->
                    <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M5 4h14v2H5zm2 4h10v2H7zm-2 4h14v2H5zm2 4h10v2H7z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">個別学習プラン</h3>
                <p class="text-gray-600">
                    一人ひとりの目標や弱点に合わせた学習プランを自動提案。効率的に勉強を進められます。
                </p>
            </div>
            <!-- 特徴3 -->
            <div class="bg-white rounded shadow p-6">
                <div class="mb-4 flex justify-center text-blue-600">
                    <!-- アイコン例 -->
                    <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 6l9 6 9-6v12H3z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">カスタムテスト機能</h3>
                <p class="text-gray-600">
                    過去問や模試を自由に組み合わせ、あなた専用の模擬試験を作成。弱点克服に役立ちます。
                </p>
            </div>
        </div>
    </section>

    <!-- クイックアクセス -->
    <section class="bg-gray-100 py-12 px-4">
        <div class="max-w-7xl mx-auto text-center mb-8">
            <h2 class="text-2xl md:text-3xl font-bold">クイックアクセス</h2>
            <p class="text-gray-600 mt-2">すぐに使いたい機能へ簡単アクセス</p>
        </div>
        <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- アクセス1 -->
            <a href="/exam-info" class="block bg-white p-6 rounded shadow hover:shadow-md transition-shadow">
                <div class="text-blue-600 mb-2">
                    <svg class="w-8 h-8 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14l4-4h12c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold">入試情報</h3>
            </a>
            <!-- アクセス2 -->
            <a href="/study-plan" class="block bg-white p-6 rounded shadow hover:shadow-md transition-shadow">
                <div class="text-blue-600 mb-2">
                    <svg class="w-8 h-8 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M5 4h14v2H5zm2 4h10v2H7zm-2 4h14v2H5zm2 4h10v2H7z" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold">学習プラン</h3>
            </a>
            <!-- アクセス3 -->
            <a href="/workbook" class="block bg-white p-6 rounded shadow hover:shadow-md transition-shadow">
                <div class="text-blue-600 mb-2">
                    <svg class="w-8 h-8 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 2H5c-1.1 0-2 .9-2 2v16l7-3 7 3V4c0-1.1-.9-2-2-2z" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold">過去問</h3>
            </a>
            <!-- アクセス4 -->
            <a href="#testimonials" class="block bg-white p-6 rounded shadow hover:shadow-md transition-shadow">
                <div class="text-blue-600 mb-2">
                    <svg class="w-8 h-8 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 12c2.7 0 5.2-1.3 6.8-3.4L12 2 5.2 8.6C6.8 10.7 9.3 12 12 12zm0 2c-3.5 0-10 1.8-10 5.3V22h20v-2.7c0-3.5-6.5-5.3-10-5.3z" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold">合格者の声</h3>
            </a>
        </div>
    </section>

    <!-- 合格者の声 (Testimonials) -->
    <section id="testimonials" class="py-12 px-4">
        <div class="max-w-7xl mx-auto text-center mb-8">
            <h2 class="text-2xl md:text-3xl font-bold">合格者の声</h2>
            <p class="text-gray-600 mt-2">先輩たちの成功体験を参考にしよう</p>
        </div>

        <!-- シンプルなカルーセル例 (Alpine.js) -->
        <div class="max-w-5xl mx-auto relative" x-data="{ currentIndex: 0 }">
            <div class="overflow-hidden">
                <!-- スライド全体を横並びに -->
                <div class="flex transition-transform duration-500"
                    :style="'transform: translateX(-' + currentIndex * 100 + '%)'">
                    <!-- スライド1 -->
                    <div class="min-w-full px-6">
                        <div class="bg-white rounded shadow p-6 mx-4">
                            <p class="text-gray-600 mb-4">
                                「効率的な学習プランのおかげで苦手科目を克服し、第一志望に合格できました！」
                            </p>
                            <div class="font-bold">Aさん（文系）</div>
                        </div>
                    </div>
                    <!-- スライド2 -->
                    <div class="min-w-full px-6">
                        <div class="bg-white rounded shadow p-6 mx-4">
                            <p class="text-gray-600 mb-4">
                                「過去問の分析ツールがとても役立ちました。合格に必要なポイントが明確になった気がします。」
                            </p>
                            <div class="font-bold">Bさん（理系）</div>
                        </div>
                    </div>
                    <!-- スライド3 -->
                    <div class="min-w-full px-6">
                        <div class="bg-white rounded shadow p-6 mx-4">
                            <p class="text-gray-600 mb-4">
                                「模擬試験を自分でカスタマイズできるので、弱点を重点的に強化できました！」
                            </p>
                            <div class="font-bold">Cさん（文系）</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ナビゲーションボタン -->
            <div class="flex justify-center mt-4 space-x-4">
                <button class="bg-blue-800 text-white px-3 py-1 rounded hover:bg-blue-700 transition-colors"
                    @click="currentIndex = (currentIndex - 1 + 3) % 3">
                    前へ
                </button>
                <button class="bg-blue-800 text-white px-3 py-1 rounded hover:bg-blue-700 transition-colors"
                    @click="currentIndex = (currentIndex + 1) % 3">
                    次へ
                </button>
            </div>
        </div>
    </section>

    <!-- 最終CTA -->
    <section class="bg-blue-900 text-white py-12 px-4">
        <div class="max-w-7xl mx-auto text-center">
            <h2 class="text-2xl md:text-3xl font-bold mb-4">あなたの合格を全力でサポートします</h2>
            <p class="mb-8 text-gray-100">
                学習プランの作成から合格まで、頼れるサポート体制を整えています。今すぐ学習を始めましょう！
            </p>
            <a href="{{ route('register') }}"
                class="inline-block bg-yellow-400 text-blue-900 font-semibold px-6 py-3 rounded shadow hover:bg-yellow-300 transition-colors">
                無料会員登録はこちら
            </a>
        </div>
    </section>
</div>
