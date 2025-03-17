<div class="bg-gray-50 min-h-screen pt-6 pb-16" x-data="{ openExamModal: false }">
    <div class="max-w-6xl mx-auto px-4">
        <!-- ヘッダーセクション -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div class="mb-4 md:mb-0">
                    <h1 class="text-2xl font-bold text-gray-800 flex items-center">
                        <span class="bg-indigo-100 text-indigo-600 p-2 rounded-lg mr-3">
                            <flux:icon.book-open class="w-6 h-6" />
                        </span>
                        情報Ⅰ 過去問演習
                    </h1>
                    <p class="text-gray-600 mt-1">過去問を解いて実力を確認しましょう</p>
                </div>

                <div class="flex space-x-2">
                    <!-- 統計ボタン -->
                    <button
                        class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50 shadow-sm transition-all flex items-center">
                        <flux:icon.chart-bar class="w-5 h-5 mr-2 text-indigo-600" />
                        <span>統計</span>
                    </button>

                    <!-- 新規問題開始ボタン -->
                    <button @click="openExamModal = true"
                        class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-4 py-2 rounded-lg hover:from-indigo-700 hover:to-purple-700 shadow-md transition-all transform hover:-translate-y-0.5 hover:shadow-lg flex items-center justify-center">
                        <flux:icon.academic-cap class="w-5 h-5 mr-2" />
                        <span>問題を解く</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- 過去問リスト -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            <!-- 問題カード1 -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-3">
                        <span
                            class="inline-block px-2 py-1 text-xs font-semibold bg-indigo-100 text-indigo-800 rounded-full">アルゴリズム</span>
                        <span class="text-gray-500 text-sm">令和6年度</span>
                    </div>
                    <h3 class="text-lg font-bold mb-2 text-gray-800">ソートアルゴリズムと計算量</h3>
                    <p class="text-gray-600 mb-4 line-clamp-2">
                        バブルソート、クイックソート、マージソートなどの各種ソートアルゴリズムの特徴と計算量について
                    </p>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center text-gray-500 text-sm">
                            <flux:icon.clock class="w-4 h-4 mr-1" />
                            <span>約20分</span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-yellow-500 mr-1">★★★☆☆</span>
                            <span class="text-sm text-gray-500">難易度: 3</span>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-6 py-4 flex justify-between">
                    <span class="text-green-600 font-medium text-sm flex items-center">
                        <flux:icon.check-circle class="w-4 h-4 mr-1" />
                        正解率: 76%
                    </span>
                    <a href="#"
                        class="text-indigo-600 font-medium text-sm hover:text-indigo-700 transition-colors">
                        問題を解く →
                    </a>
                </div>
            </div>

            <!-- 問題カード2 -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-3">
                        <span
                            class="inline-block px-2 py-1 text-xs font-semibold bg-purple-100 text-purple-800 rounded-full">データベース</span>
                        <span class="text-gray-500 text-sm">令和5年度</span>
                    </div>
                    <h3 class="text-lg font-bold mb-2 text-gray-800">リレーショナルデータベースの設計</h3>
                    <p class="text-gray-600 mb-4 line-clamp-2">
                        正規化の概念と主キー、外部キーの役割について学ぶ問題です
                    </p>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center text-gray-500 text-sm">
                            <flux:icon.clock class="w-4 h-4 mr-1" />
                            <span>約15分</span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-yellow-500 mr-1">★★☆☆☆</span>
                            <span class="text-sm text-gray-500">難易度: 2</span>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-6 py-4 flex justify-between">
                    <span class="text-green-600 font-medium text-sm flex items-center">
                        <flux:icon.check-circle class="w-4 h-4 mr-1" />
                        正解率: 82%
                    </span>
                    <a href="#"
                        class="text-indigo-600 font-medium text-sm hover:text-indigo-700 transition-colors">
                        問題を解く →
                    </a>
                </div>
            </div>

            <!-- 問題カード3 -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-3">
                        <span
                            class="inline-block px-2 py-1 text-xs font-semibold bg-blue-100 text-blue-800 rounded-full">ネットワーク</span>
                        <span class="text-gray-500 text-sm">令和4年度</span>
                    </div>
                    <h3 class="text-lg font-bold mb-2 text-gray-800">TCP/IPの基本と通信プロトコル</h3>
                    <p class="text-gray-600 mb-4 line-clamp-2">
                        インターネット通信の基本となるTCP/IPプロトコルスタックと各層の役割について
                    </p>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center text-gray-500 text-sm">
                            <flux:icon.clock class="w-4 h-4 mr-1" />
                            <span>約25分</span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-yellow-500 mr-1">★★★★☆</span>
                            <span class="text-sm text-gray-500">難易度: 4</span>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-6 py-4 flex justify-between">
                    <span class="text-orange-600 font-medium text-sm flex items-center">
                        <flux:icon.exclamation-circle class="w-4 h-4 mr-1" />
                        正解率: 59%
                    </span>
                    <a href="#"
                        class="text-indigo-600 font-medium text-sm hover:text-indigo-700 transition-colors">
                        問題を解く →
                    </a>
                </div>
            </div>

            <!-- 問題カード4 -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-3">
                        <span
                            class="inline-block px-2 py-1 text-xs font-semibold bg-red-100 text-red-800 rounded-full">情報セキュリティ</span>
                        <span class="text-gray-500 text-sm">令和3年度</span>
                    </div>
                    <h3 class="text-lg font-bold mb-2 text-gray-800">情報セキュリティの脅威と対策</h3>
                    <p class="text-gray-600 mb-4 line-clamp-2">
                        マルウェア、フィッシング詐欺、DoS攻撃などの脅威とそれらへの対策を学ぶ問題
                    </p>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center text-gray-500 text-sm">
                            <flux:icon.clock class="w-4 h-4 mr-1" />
                            <span>約30分</span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-yellow-500 mr-1">★★★★★</span>
                            <span class="text-sm text-gray-500">難易度: 5</span>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-6 py-4 flex justify-between">
                    <span class="text-red-600 font-medium text-sm flex items-center">
                        <flux:icon.exclamation-triangle class="w-4 h-4 mr-1" />
                        正解率: 42%
                    </span>
                    <a href="#"
                        class="text-indigo-600 font-medium text-sm hover:text-indigo-700 transition-colors">
                        問題を解く →
                    </a>
                </div>
            </div>

            <!-- 問題カード5 -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-3">
                        <span
                            class="inline-block px-2 py-1 text-xs font-semibold bg-indigo-100 text-indigo-800 rounded-full">アルゴリズム</span>
                        <span class="text-gray-500 text-sm">令和2年度</span>
                    </div>
                    <h3 class="text-lg font-bold mb-2 text-gray-800">再帰アルゴリズムと動的計画法</h3>
                    <p class="text-gray-600 mb-4 line-clamp-2">
                        再帰的なアルゴリズムと動的計画法を用いた効率的な問題解決方法
                    </p>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center text-gray-500 text-sm">
                            <flux:icon.clock class="w-4 h-4 mr-1" />
                            <span>約35分</span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-yellow-500 mr-1">★★★★☆</span>
                            <span class="text-sm text-gray-500">難易度: 4</span>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-6 py-4 flex justify-between">
                    <span class="text-orange-600 font-medium text-sm flex items-center">
                        <flux:icon.exclamation-circle class="w-4 h-4 mr-1" />
                        正解率: 55%
                    </span>
                    <a href="#"
                        class="text-indigo-600 font-medium text-sm hover:text-indigo-700 transition-colors">
                        問題を解く →
                    </a>
                </div>
            </div>

            <!-- 問題カード6 -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-3">
                        <span
                            class="inline-block px-2 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded-full">プログラミング</span>
                        <span class="text-gray-500 text-sm">令和元年度</span>
                    </div>
                    <h3 class="text-lg font-bold mb-2 text-gray-800">オブジェクト指向プログラミング</h3>
                    <p class="text-gray-600 mb-4 line-clamp-2">
                        クラス、オブジェクト、継承、カプセル化などのオブジェクト指向の基本概念
                    </p>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center text-gray-500 text-sm">
                            <flux:icon.clock class="w-4 h-4 mr-1" />
                            <span>約25分</span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-yellow-500 mr-1">★★★☆☆</span>
                            <span class="text-sm text-gray-500">難易度: 3</span>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-6 py-4 flex justify-between">
                    <span class="text-green-600 font-medium text-sm flex items-center">
                        <flux:icon.check-circle class="w-4 h-4 mr-1" />
                        正解率: 67%
                    </span>
                    <a href="#"
                        class="text-indigo-600 font-medium text-sm hover:text-indigo-700 transition-colors">
                        問題を解く →
                    </a>
                </div>
            </div>
        </div>

        <!-- ページネーション -->
        <div class="mt-8 flex justify-center">
            <nav class="flex items-center space-x-1">
                <a href="#"
                    class="px-3 py-2 rounded-lg border border-gray-300 text-gray-500 hover:bg-gray-50 transition-colors">
                    <flux:icon.chevron-left class="w-5 h-5" />
                </a>
                <a href="#" class="px-4 py-2 rounded-lg border border-indigo-500 bg-indigo-500 text-white">
                    1
                </a>
                <a href="#"
                    class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition-colors">
                    2
                </a>
                <a href="#"
                    class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition-colors">
                    3
                </a>
                <span class="px-4 py-2 text-gray-600">...</span>
                <a href="#"
                    class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition-colors">
                    12
                </a>
                <a href="#"
                    class="px-3 py-2 rounded-lg border border-gray-300 text-gray-500 hover:bg-gray-50 transition-colors">
                    <flux:icon.chevron-right class="w-5 h-5" />
                </a>
            </nav>
        </div>
    </div>

    <!-- 問題開始モーダル -->
    <template x-if="openExamModal">
        <div class="fixed inset-0 flex items-center justify-center z-50">
            <!-- 背景のオーバーレイ -->
            <div class="absolute inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm" @click="openExamModal = false">
            </div>
            <!-- モーダル本体 -->
            <div class="bg-white rounded-xl shadow-xl z-50 p-6 w-full max-w-md m-4 transform transition-all duration-300"
                x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
                <div class="text-center mb-6">
                    <div
                        class="w-16 h-16 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 mx-auto mb-4">
                        <flux:icon.academic-cap class="w-8 h-8" />
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800">問題を選択</h2>
                    <p class="text-gray-600 mt-1">解きたい問題の種類を選んでください</p>
                </div>

                <div class="space-y-3 mb-6">
                    <button
                        class="w-full p-4 border border-gray-200 rounded-lg text-left hover:border-indigo-300 hover:bg-indigo-50 transition-colors flex items-center">
                        <div
                            class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 mr-3">
                            <flux:icon.fire class="w-5 h-5" />
                        </div>
                        <div>
                            <div class="font-medium">令和6年度の問題</div>
                            <div class="text-sm text-gray-500">最新の情報Ⅰ試験問題</div>
                        </div>
                    </button>

                    <button
                        class="w-full p-4 border border-gray-200 rounded-lg text-left hover:border-indigo-300 hover:bg-indigo-50 transition-colors flex items-center">
                        <div
                            class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 mr-3">
                            <flux:icon.clock class="w-5 h-5" />
                        </div>
                        <div>
                            <div class="font-medium">令和5年度の問題</div>
                            <div class="text-sm text-gray-500">前年度の試験問題</div>
                        </div>
                    </button>

                    <button
                        class="w-full p-4 border border-gray-200 rounded-lg text-left hover:border-indigo-300 hover:bg-indigo-50 transition-colors flex items-center">
                        <div
                            class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600 mr-3">
                            <flux:icon.star class="w-5 h-5" />
                        </div>
                        <div>
                            <div class="font-medium">令和4年度の問題</div>
                            <div class="text-sm text-gray-500">2年前の試験問題</div>
                        </div>
                    </button>

                    <button
                        class="w-full p-4 border border-gray-200 rounded-lg text-left hover:border-indigo-300 hover:bg-indigo-50 transition-colors flex items-center">
                        <div
                            class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600 mr-3">
                            <flux:icon.arrows-pointing-out class="w-5 h-5" />
                        </div>
                        <div>
                            <div class="font-medium">別の年度を選択</div>
                            <div class="text-sm text-gray-500">過去の試験問題から選ぶ</div>
                        </div>
                    </button>
                </div>

                <div class="flex justify-end">
                    <button @click="openExamModal = false"
                        class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                        キャンセル
                    </button>
                </div>
            </div>
        </div>
    </template>
</div>
