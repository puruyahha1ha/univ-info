<section class="py-16 px-4 bg-gray-50">
    <div class="max-w-7xl mx-auto text-center mb-12">
        <span class="inline-block px-3 py-1 rounded-full bg-blue-100 text-blue-600 font-medium text-sm mb-3">過去問演習</span>
        <h2 class="text-2xl md:text-3xl font-bold text-gray-800">共通テスト<span class="text-blue-600">「情報Ⅰ」</span>過去問</h2>
        <p class="text-gray-600 mt-3 max-w-2xl mx-auto">年度別の問題を一問一答形式で解いて実力アップ！</p>
    </div>

    <div class="max-w-6xl mx-auto mb-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- 各年度のカード -->
            <div
                class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl transform hover:-translate-y-2">
                <div class="h-24 bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center">
                    <h3 class="text-2xl font-bold text-white">2025年度</h3>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 mb-4">令和7年度 共通テスト「情報Ⅰ」の過去問題を解いて実力を確認しましょう。</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">全20問</span>
                        <a href="{{ route('workbook.year', ['year' => 2025]) }}"
                            class="inline-block bg-indigo-600 text-white font-medium px-4 py-2 rounded-md hover:bg-indigo-700 transition-colors"
                            wire:navigate>
                            問題を解く
                        </a>
                    </div>
                </div>
            </div>

            <div
                class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl transform hover:-translate-y-2">
                <div class="h-24 bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center">
                    <h3 class="text-2xl font-bold text-white">2024年度</h3>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 mb-4">令和6年度 共通テスト「情報Ⅰ」の過去問題を解いて実力を確認しましょう。</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">全20問</span>
                        <a href="{{ route('workbook.year', ['year' => 2024]) }}"
                            class="inline-block bg-indigo-600 text-white font-medium px-4 py-2 rounded-md hover:bg-indigo-700 transition-colors"
                            wire:navigate>
                            問題を解く
                        </a>
                    </div>
                </div>
            </div>

            <div
                class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl transform hover:-translate-y-2">
                <div class="h-24 bg-gradient-to-r from-purple-500 to-pink-600 flex items-center justify-center">
                    <h3 class="text-2xl font-bold text-white">2023年度</h3>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 mb-4">令和5年度 共通テスト「情報Ⅰ」の過去問題を解いて実力を確認しましょう。</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">全20問</span>
                        <a href="{{ route('workbook.year', ['year' => 2023]) }}"
                            class="inline-block bg-indigo-600 text-white font-medium px-4 py-2 rounded-md hover:bg-indigo-700 transition-colors"
                            wire:navigate>
                            問題を解く
                        </a>
                    </div>
                </div>
            </div>

            <!-- 模擬試験カード -->
            <div
                class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl transform hover:-translate-y-2">
                <div class="h-24 bg-gradient-to-r from-yellow-500 to-orange-600 flex items-center justify-center">
                    <h3 class="text-2xl font-bold text-white">模擬試験</h3>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 mb-4">複数年度の問題からランダムに出題される模擬試験に挑戦しましょう。</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">ランダム20問</span>
                        <a href="{{ route('workbook.mock') }}"
                            class="inline-block bg-yellow-600 text-white font-medium px-4 py-2 rounded-md hover:bg-yellow-700 transition-colors"
                            wire:navigate>
                            受験する
                        </a>
                    </div>
                </div>
            </div>

            <!-- カスタム試験カード -->
            <div
                class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl transform hover:-translate-y-2">
                <div class="h-24 bg-gradient-to-r from-green-500 to-teal-600 flex items-center justify-center">
                    <h3 class="text-2xl font-bold text-white">カスタム試験</h3>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 mb-4">自分だけの問題セットを作成して、苦手分野を重点的に学習しましょう。</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">問題数自由設定</span>
                        <a href="{{ route('workbook.custom') }}"
                            class="inline-block bg-green-600 text-white font-medium px-4 py-2 rounded-md hover:bg-green-700 transition-colors"
                            wire:navigate>
                            作成する
                        </a>
                    </div>
                </div>
            </div>

            <!-- 弱点克服カード -->
            <div
                class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl transform hover:-translate-y-2">
                <div class="h-24 bg-gradient-to-r from-red-500 to-pink-600 flex items-center justify-center">
                    <h3 class="text-2xl font-bold text-white">弱点克服</h3>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 mb-4">あなたの苦手分野を分析し、苦手問題だけを集めた特訓セットです。</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">パーソナライズ</span>
                        <a href="{{ route('workbook.weakness') }}"
                            class="inline-block bg-red-600 text-white font-medium px-4 py-2 rounded-md hover:bg-red-700 transition-colors"
                            wire:navigate>
                            特訓する
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 学習進捗状況 -->
    <div class="max-w-6xl mx-auto mt-12 bg-white rounded-xl shadow-lg p-6">
        <h3 class="text-xl font-bold text-gray-800 mb-4">あなたの学習進捗状況</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-gray-50 rounded-lg p-4">
                <div class="flex justify-between items-center mb-2">
                    <h4 class="font-semibold text-gray-700">総問題数</h4>
                    <span class="text-sm text-blue-600 font-medium">60問中25問完了</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3">
                    <div class="bg-blue-600 h-3 rounded-full" style="width: 42%"></div>
                </div>
            </div>
            <div class="bg-gray-50 rounded-lg p-4">
                <div class="flex justify-between items-center mb-2">
                    <h4 class="font-semibold text-gray-700">正答率</h4>
                    <span class="text-sm text-green-600 font-medium">78%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3">
                    <div class="bg-green-600 h-3 rounded-full" style="width: 78%"></div>
                </div>
            </div>
            <div class="bg-gray-50 rounded-lg p-4">
                <div class="flex justify-between items-center mb-2">
                    <h4 class="font-semibold text-gray-700">学習時間</h4>
                    <span class="text-sm text-purple-600 font-medium">合計5.2時間</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3">
                    <div class="bg-purple-600 h-3 rounded-full" style="width: 52%"></div>
                </div>
            </div>
        </div>
    </div>
</section>
