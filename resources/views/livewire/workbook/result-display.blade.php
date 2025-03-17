<section class="max-w-5xl mx-auto py-12 px-4">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- 結果ヘッダー -->
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 py-8 px-6 text-white">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold">{{ $year }}年度 過去問結果</h1>
                    <p class="mt-2 text-indigo-100">{{ now()->format('Y年m月d日 H:i') }} 完了</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <div class="text-5xl font-bold">{{ $score }}点</div>
                    <div class="text-indigo-200 text-right">満点: {{ $totalPoints }}点</div>
                </div>
            </div>
        </div>

        <!-- 結果サマリー -->
        <div class="p-6 md:p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">正答率</h3>
                    <div class="flex items-end">
                        <div class="text-3xl font-bold text-indigo-600">{{ number_format($correctPercentage, 1) }}%
                        </div>
                        <div class="ml-2 text-sm text-gray-500">({{ $correctCount }}/{{ $totalQuestions }}問)</div>
                    </div>
                    <div class="mt-3 w-full bg-gray-200 rounded-full h-3">
                        <div class="bg-indigo-600 h-3 rounded-full" style="width: {{ $correctPercentage }}%"></div>
                    </div>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">所要時間</h3>
                    <div class="text-3xl font-bold text-indigo-600">{{ $timeSpent }}</div>
                    <div class="mt-2 text-sm text-gray-500">平均: 1問あたり {{ $averageTimePerQuestion }}秒</div>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">苦手カテゴリ</h3>
                    <div class="text-lg font-bold text-red-600">{{ $weakestCategory }}</div>
                    <div class="mt-2 text-sm text-gray-500">正答率: {{ $weakestCategoryPercentage }}%</div>
                </div>
            </div>

            <!-- カテゴリ別成績 -->
            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-800 mb-4">カテゴリ別成績</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="py-3 px-4 text-left font-semibold text-gray-700 border-b">カテゴリ</th>
                                <th class="py-3 px-4 text-left font-semibold text-gray-700 border-b">正解数</th>
                                <th class="py-3 px-4 text-left font-semibold text-gray-700 border-b">問題数</th>
                                <th class="py-3 px-4 text-left font-semibold text-gray-700 border-b">正答率</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categoryResults as $category => $result)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-3 px-4 text-gray-800">{{ $category }}</td>
                                    <td class="py-3 px-4 text-gray-800">{{ $result['correct'] }}</td>
                                    <td class="py-3 px-4 text-gray-800">{{ $result['total'] }}</td>
                                    <td class="py-3 px-4">
                                        <div class="flex items-center">
                                            <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                                                <div class="bg-indigo-600 h-2 rounded-full"
                                                    style="width: {{ $result['percentage'] }}%"></div>
                                            </div>
                                            <span
                                                class="text-gray-800">{{ number_format($result['percentage'], 1) }}%</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- 問題別の結果 -->
            <!-- 問題別の結果セクション（スマホ対応版） -->
            <div>
                <h2 class="text-xl font-bold text-gray-800 mb-4">問題別結果</h2>
                <div class="space-y-3">
                    @foreach ($questionResults as $index => $result)
                        <div class="border rounded-lg overflow-hidden">
                            <!-- 問題ヘッダー（スマホでは縦並びに調整） -->
                            <div class="px-4 py-3 {{ $result['correct'] ? 'bg-green-50' : 'bg-red-50' }}">
                                <div class="flex flex-col sm:flex-row sm:items-center">
                                    <!-- 問題番号 -->
                                    <div class="flex items-center mb-2 sm:mb-0">
                                        <div
                                            class="w-8 h-8 rounded-full flex items-center justify-center {{ $result['correct'] ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }} mr-3">
                                            {{ $index + 1 }}
                                        </div>
                                        <!-- スマホでは結果アイコンをここに配置 -->
                                        <div class="sm:hidden">
                                            @if ($result['correct'])
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                    正解
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                    不正解
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- 問題情報 -->
                                    <div class="flex-grow mb-2 sm:mb-0">
                                        <div class="font-medium text-gray-800 text-sm sm:text-base">
                                            問{{ $index + 1 }}: {{ mb_substr($result['question'], 0, 30) }}...</div>
                                        <div class="text-xs sm:text-sm text-gray-600">{{ $result['category'] }}
                                            ({{ $result['points'] }}点)</div>
                                    </div>

                                    <!-- PC表示用の結果アイコン -->
                                    <div class="hidden sm:block sm:ml-4">
                                        @if ($result['correct'])
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                正解
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                不正解
                                            </span>
                                        @endif
                                    </div>

                                    <!-- 開閉ボタン -->
                                    <div class="flex justify-end">
                                        <button class="text-indigo-600 hover:text-indigo-800"
                                            @click="$refs.details{{ $index }}.classList.toggle('hidden')">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- 詳細部分（初期状態では非表示） -->
                            <div x-ref="details{{ $index }}" class="hidden p-4 bg-white border-t">
                                <div class="mb-3">
                                    <div class="font-medium text-gray-700 mb-1">問題:</div>
                                    <div class="text-gray-800 text-sm sm:text-base">{{ $result['question'] }}</div>
                                </div>

                                <div class="mb-3">
                                    <div class="font-medium text-gray-700 mb-1">あなたの回答:</div>
                                    <div
                                        class="{{ $result['correct'] ? 'text-green-600' : 'text-red-600' }} text-sm sm:text-base">
                                        {{ $result['selected'] }}: {{ $result['selectedText'] }}
                                    </div>
                                </div>

                                @if (!$result['correct'])
                                    <div class="mb-3">
                                        <div class="font-medium text-gray-700 mb-1">正解:</div>
                                        <div class="text-green-600 text-sm sm:text-base">
                                            {{ $result['correctAnswer'] }}: {{ $result['correctText'] }}
                                        </div>
                                    </div>
                                @endif

                                <div>
                                    <div class="font-medium text-gray-700 mb-1">解説:</div>
                                    <div class="text-gray-800 text-sm sm:text-base">{{ $result['explanation'] }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- アクションボタン -->
            <div class="mt-8 flex flex-col sm:flex-row sm:justify-between space-y-4 sm:space-y-0">
                <div class="flex space-x-4">
                    <a href="{{ route('workbook.year', ['year' => $year]) }}"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                            </path>
                        </svg>
                        もう一度解く
                    </a>
                    <a href="{{ route('workbook') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        問題一覧に戻る
                    </a>
                </div>
                <button
                    class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    結果を保存する
                </button>
            </div>
        </div>
    </div>
</section>
