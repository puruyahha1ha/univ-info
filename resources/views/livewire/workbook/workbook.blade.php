<div>
    <section class="py-8 sm:py-12 px-4 bg-gray-50">
        <div class="max-w-7xl mx-auto text-center mb-8 sm:mb-12">
            <span
                class="inline-block px-3 py-1 rounded-full bg-blue-100 text-blue-600 font-medium text-sm mb-3">過去問一覧</span>
            <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-gray-800">共通テスト<span
                    class="text-blue-600">「情報Ⅰ」</span>演習問題</h2>
            <p class="text-gray-600 mt-3 max-w-2xl mx-auto text-sm sm:text-base">
                問題を検索してピンポイントで学習できます。フィルターを使って効率的に学習しましょう。</p>
        </div>

        <div class="max-w-6xl mx-auto">
            <!-- ユーザーの学習進捗状況（ログイン時のみ） -->
            @auth
                <div
                    class="mb-8 sm:mb-10 bg-white rounded-xl shadow-lg p-4 sm:p-6 transition-all duration-300 hover:shadow-xl">
                    <h3 class="text-lg sm:text-xl font-bold text-gray-800 mb-4">あなたの学習進捗状況</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex justify-between items-center mb-2">
                                <h4 class="font-semibold text-gray-700 text-sm">解答状況</h4>
                                <span
                                    class="text-xs sm:text-sm text-blue-600 font-medium">{{ $stats['answered_questions'] }}
                                    / {{ $stats['total_questions'] }}問</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2 sm:h-3">
                                <div class="bg-blue-600 h-2 sm:h-3 rounded-full"
                                    style="width: {{ $stats['answered_percentage'] }}%"></div>
                            </div>
                            <div class="mt-2 text-xs sm:text-sm text-gray-500">
                                未解答: {{ $stats['total_pending'] }}問
                            </div>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex justify-between items-center mb-2">
                                <h4 class="font-semibold text-gray-700 text-sm">正答率</h4>
                                <span
                                    class="text-xs sm:text-sm text-green-600 font-medium">{{ $stats['correct_percentage'] }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2 sm:h-3">
                                <div class="bg-green-600 h-2 sm:h-3 rounded-full"
                                    style="width: {{ $stats['correct_percentage'] }}%"></div>
                            </div>
                            <div class="mt-2 text-xs sm:text-sm text-gray-500">
                                @if ($stats['weak_category'])
                                    弱点: {{ $stats['weak_category'] }}
                                @else
                                    弱点分析はまだありません
                                @endif
                            </div>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex justify-between items-center mb-2">
                                <h4 class="font-semibold text-gray-700 text-sm">学習時間</h4>
                                <span
                                    class="text-xs sm:text-sm text-purple-600 font-medium">{{ $stats['study_time'] }}</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2 sm:h-3">
                                <div class="bg-purple-600 h-2 sm:h-3 rounded-full"
                                    style="width: {{ min(($stats['total_completed'] / max($stats['total_questions'], 1)) * 100, 100) }}%">
                                </div>
                            </div>
                            <div class="mt-2 text-xs sm:text-sm text-gray-500">
                                @if (count($stats['recent_sessions']) > 0)
                                    最終学習: {{ $stats['recent_sessions'][0]->completed_at->diffForHumans() }}
                                @else
                                    まだ学習記録がありません
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endauth

            <!-- フィルター・検索セクション -->
            <div
                class="mb-6 sm:mb-8 bg-white rounded-xl shadow-lg p-4 sm:p-6 transition-all duration-300 hover:shadow-xl">
                <h3 class="text-md sm:text-lg font-medium text-gray-900 mb-4">問題検索・フィルター</h3>

                <div class="space-y-4">
                    <!-- 検索ボックス -->
                    <div>
                        <label for="search"
                            class="block text-xs sm:text-sm font-medium text-gray-700 mb-1">キーワード検索</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" id="search" wire:model="search" wire:input="$refresh"
                                placeholder="キーワードを入力"
                                class="pl-10 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-xs sm:text-sm">
                            @if ($search)
                                <button wire:click="$set('search', '')"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <!-- 年度フィルター -->
                        <div>
                            <label for="yearFilter"
                                class="block text-xs sm:text-sm font-medium text-gray-700 mb-1">年度</label>
                            <select id="yearFilter" wire:model.live="yearFilter"
                                class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-xs sm:text-sm">
                                <option value="">すべての年度</option>
                                @foreach ($years as $year)
                                    <option value="{{ $year }}">{{ $year }}年度</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- カテゴリフィルター -->
                        <div>
                            <label for="categoryFilter"
                                class="block text-xs sm:text-sm font-medium text-gray-700 mb-1">カテゴリ</label>
                            <select id="categoryFilter" wire:model.live="categoryFilter"
                                class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-xs sm:text-sm">
                                <option value="">すべてのカテゴリ</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category }}">{{ $category }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- 難易度フィルター -->
                        <div>
                            <label for="difficultyFilter"
                                class="block text-xs sm:text-sm font-medium text-gray-700 mb-1">難易度</label>
                            <select id="difficultyFilter" wire:model.live="difficultyFilter"
                                class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-xs sm:text-sm">
                                <option value="">すべての難易度</option>
                                @foreach ($difficulties as $difficulty)
                                    <option value="{{ $difficulty }}">{{ str_repeat('★', $difficulty) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- フィルターリセットボタン -->
                    <div class="flex justify-end">
                        <button wire:click="resetFilters"
                            class="inline-flex items-center px-3 py-1.5 sm:px-4 sm:py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition-colors text-xs sm:text-sm">
                            <flux:icon.arrow-path class="w-3 h-3 sm:w-4 sm:h-4 mr-1 sm:mr-2" />
                            リセット
                        </button>
                    </div>
                </div>
            </div>

            <!-- 問題一覧（SP用カード表示とPC用テーブル表示を切り替え） -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl">
                <div class="p-4 sm:p-6">
                    <div class="flex justify-between items-center mb-4 sm:mb-6">
                        <h3 class="text-md sm:text-lg font-medium text-gray-900">問題一覧</h3>
                        <div class="text-xs sm:text-sm text-gray-500">
                            {{ $questions->total() }}件中
                            {{ $questions->firstItem() ?? 0 }}-{{ $questions->lastItem() ?? 0 }}件表示
                        </div>
                    </div>

                    @if ($questions->isEmpty())
                        <div class="text-center py-8 sm:py-12">
                            <svg class="mx-auto h-10 w-10 sm:h-12 sm:w-12 text-gray-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">問題が見つかりません</h3>
                            <p class="mt-1 text-xs sm:text-sm text-gray-500">フィルター条件を変更して再度お試しください</p>
                            <div class="mt-4 sm:mt-6">
                                <button wire:click="resetFilters"
                                    class="inline-flex items-center px-3 py-1.5 sm:px-4 sm:py-2 border border-transparent rounded-md shadow-sm text-xs sm:text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    フィルターをリセット
                                </button>
                            </div>
                        </div>
                    @else
                        <!-- SP用カードビュー -->
                        <div class="block sm:hidden space-y-4">
                            @foreach ($questions as $question)
                                <div
                                    class="border rounded-lg overflow-hidden bg-gray-50 hover:bg-blue-50 transition-colors">
                                    <div class="p-4">
                                        <div class="flex justify-between items-start mb-2">
                                            <div class="flex items-center">
                                                <span
                                                    class="px-2 py-1 inline-flex text-xs leading-4 font-semibold rounded-full bg-blue-100 text-blue-800 mr-2">
                                                    {{ $question->category }}
                                                </span>
                                                <span class="text-yellow-500 text-xs">
                                                    {{ str_repeat('★', $question->difficulty) }}
                                                </span>
                                            </div>
                                            <span class="text-xs text-gray-500">{{ $question->year }}年度</span>
                                        </div>

                                        <div class="text-sm font-medium text-gray-900 mb-2 line-clamp-2">
                                            {{ Str::limit(strip_tags($question->question_text), 60) }}
                                        </div>

                                        <div class="flex justify-between items-center">
                                            <div>
                                                @auth
                                                    @if (in_array($question->id, $userProgress['answered_questions'] ?? []))
                                                        @if (in_array($question->id, $userProgress['correct_questions'] ?? []))
                                                            <span
                                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                                <svg class="w-3 h-3 mr-1" fill="currentColor"
                                                                    viewBox="0 0 20 20">
                                                                    <path fill-rule="evenodd"
                                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                                        clip-rule="evenodd"></path>
                                                                </svg>
                                                                正解済
                                                            </span>
                                                        @else
                                                            <span
                                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                                <svg class="w-3 h-3 mr-1" fill="currentColor"
                                                                    viewBox="0 0 20 20">
                                                                    <path fill-rule="evenodd"
                                                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                        clip-rule="evenodd"></path>
                                                                </svg>
                                                                不正解
                                                            </span>
                                                        @endif
                                                    @else
                                                        <span
                                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                            未解答
                                                        </span>
                                                    @endif
                                                @else
                                                    <span class="text-xs text-gray-500">
                                                        {{ $question->points }}点
                                                    </span>
                                                @endauth
                                            </div>

                                            {{-- <a href="{{ route('workbook.single-question', ['question_id' => $question->id]) }}" --}}
                                            <a href="#"
                                                class="inline-block bg-indigo-600 text-white font-medium px-3 py-1 text-xs rounded hover:bg-indigo-700 transition-colors">
                                                解く
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- PC用テーブルビュー -->
                        <div class="hidden sm:block overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            問題
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            カテゴリ
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            難易度
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            年度
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            状態
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            アクション
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($questions as $question)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4">
                                                <div class="flex items-center">
                                                    <div class="ml-0">
                                                        <div
                                                            class="text-sm font-medium text-gray-900 truncate max-w-xs">
                                                            {{ Str::limit(strip_tags($question->question_text), 50) }}
                                                        </div>
                                                        <div class="text-sm text-gray-500">
                                                            {{ $question->points }}点
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                    {{ $question->category }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-yellow-500">
                                                    {{ str_repeat('★', $question->difficulty) }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $question->year }}年度
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @auth
                                                    @if (in_array($question->id, $userProgress['answered_questions'] ?? []))
                                                        @if (in_array($question->id, $userProgress['correct_questions'] ?? []))
                                                            <span
                                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                                <svg class="w-3 h-3 mr-1" fill="currentColor"
                                                                    viewBox="0 0 20 20">
                                                                    <path fill-rule="evenodd"
                                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                                        clip-rule="evenodd"></path>
                                                                </svg>
                                                                正解済み
                                                            </span>
                                                        @else
                                                            <span
                                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                                <svg class="w-3 h-3 mr-1" fill="currentColor"
                                                                    viewBox="0 0 20 20">
                                                                    <path fill-rule="evenodd"
                                                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                        clip-rule="evenodd"></path>
                                                                </svg>
                                                                不正解
                                                            </span>
                                                        @endif
                                                    @else
                                                        <span
                                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                            未解答
                                                        </span>
                                                    @endif
                                                @else
                                                    <span
                                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                        -
                                                    </span>
                                                @endauth
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                {{-- <a href="{{ route('workbook.single-question', ['question_id' => $question->id]) }}" --}}
                                                <a href="#"
                                                    class="inline-block bg-indigo-600 text-white font-medium px-3 py-1 rounded hover:bg-indigo-700 transition-colors">
                                                    解く
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4 sm:mt-6">
                            {{ $questions->links() }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- 年度別・カテゴリ別クイックアクセス -->
            <div class="mt-8 sm:mt-12 space-y-6 sm:space-y-0 sm:grid sm:grid-cols-2 sm:gap-6">
                <!-- 年度別クイックアクセス -->
                <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6 transition-all duration-300 hover:shadow-xl">
                    <h3 class="text-md sm:text-lg font-medium text-gray-900 mb-3 sm:mb-4">年度別解答</h3>
                    <div class="grid grid-cols-2 gap-2 sm:gap-3">
                        @foreach ($years as $year)
                            <a href="{{ route('workbook.year', ['year' => $year]) }}"
                                class="inline-flex items-center justify-between px-3 py-2 bg-gray-50 text-gray-800 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition-colors border border-gray-200 text-xs sm:text-sm">
                                <span>{{ $year }}年度</span>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- カテゴリ別クイックアクセス -->
                <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6 transition-all duration-300 hover:shadow-xl">
                    <h3 class="text-md sm:text-lg font-medium text-gray-900 mb-3 sm:mb-4">カテゴリ別学習</h3>
                    <div class="grid grid-cols-1 xs:grid-cols-2 gap-2 sm:gap-3">
                        @foreach ($categories as $category)
                            <a href="#" wire:click.prevent="$set('categoryFilter', '{{ $category }}')"
                                class="inline-flex items-center justify-between px-3 py-2 bg-gray-50 text-gray-800 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition-colors border border-gray-200 text-xs sm:text-sm truncate">
                                <span class="truncate">{{ $category }}</span>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 flex-shrink-0 ml-1" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
