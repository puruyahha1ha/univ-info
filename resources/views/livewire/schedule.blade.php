<div class="bg-gray-50 min-h-screen pt-6 pb-16" x-data="{ openModal: false, activeTab: 'calendar' }">
    <div class="max-w-5xl mx-auto px-4">
        <!-- ヘッダーセクション -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div class="mb-4 md:mb-0">
                    <h1 class="text-2xl font-bold text-gray-800 flex items-center">
                        <span class="bg-indigo-100 text-indigo-600 p-2 rounded-lg mr-3">
                            <flux:icon.calendar class="w-6 h-6" />
                        </span>
                        スケジュール管理
                    </h1>
                    <p class="text-gray-600 mt-1">学習計画を管理して、効率的に勉強しましょう</p>
                </div>

                <!-- スケジュール追加ボタン -->
                <button @click="openModal = true"
                    class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-5 py-3 rounded-lg hover:from-indigo-700 hover:to-purple-700 shadow-md transition-all transform hover:-translate-y-0.5 hover:shadow-lg flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    スケジュール追加
                </button>
            </div>
        </div>

        <!-- タブナビゲーション -->
        <div class="bg-white rounded-xl shadow-md mb-6 p-1 flex">
            <button @click="activeTab = 'calendar'"
                :class="activeTab === 'calendar' ? 'bg-indigo-100 text-indigo-700' : 'text-gray-700 hover:bg-gray-100'"
                class="flex-1 py-3 rounded-lg font-medium transition-colors flex items-center justify-center">
                <flux:icon.calendar class="w-5 h-5 mr-2" />
                カレンダー
            </button>
            <button @click="activeTab = 'list'"
                :class="activeTab === 'list' ? 'bg-indigo-100 text-indigo-700' : 'text-gray-700 hover:bg-gray-100'"
                class="flex-1 py-3 rounded-lg font-medium transition-colors flex items-center justify-center">
                <flux:icon.list-bullet class="w-5 h-5 mr-2" />
                リスト
            </button>
        </div>

        <!-- カレンダービュー -->
        <div x-show="activeTab === 'calendar'" class="bg-white rounded-xl shadow-md p-6 mb-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-gray-800">2025年3月</h2>
                <div class="flex space-x-2">
                    <button class="p-2 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                    </button>
                    <button class="p-2 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border-collapse">
                    <thead>
                        <tr>
                            <th class="py-3 px-4 text-red-500 font-medium border-b border-gray-200">日</th>
                            <th class="py-3 px-4 text-gray-700 font-medium border-b border-gray-200">月</th>
                            <th class="py-3 px-4 text-gray-700 font-medium border-b border-gray-200">火</th>
                            <th class="py-3 px-4 text-gray-700 font-medium border-b border-gray-200">水</th>
                            <th class="py-3 px-4 text-gray-700 font-medium border-b border-gray-200">木</th>
                            <th class="py-3 px-4 text-gray-700 font-medium border-b border-gray-200">金</th>
                            <th class="py-3 px-4 text-blue-500 font-medium border-b border-gray-200">土</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-1 px-2 border border-gray-200 align-top h-24">
                                <div class="font-medium text-red-500 mb-1">1</div>
                                <div class="text-xs p-1 bg-indigo-100 text-indigo-700 rounded mb-1 truncate">過去問演習</div>
                            </td>
                            <td class="py-1 px-2 border border-gray-200 align-top h-24">
                                <div class="font-medium text-gray-700 mb-1">2</div>
                                <div class="text-xs p-1 bg-purple-100 text-purple-700 rounded mb-1 truncate">ネットワーク復習
                                </div>
                            </td>
                            <td class="py-1 px-2 border border-gray-200 align-top h-24">
                                <div class="font-medium text-gray-700 mb-1">3</div>
                            </td>
                            <td class="py-1 px-2 border border-gray-200 align-top h-24">
                                <div class="font-medium text-gray-700 mb-1">4</div>
                                <div class="text-xs p-1 bg-yellow-100 text-yellow-700 rounded mb-1 truncate">模試</div>
                            </td>
                            <td class="py-1 px-2 border border-gray-200 align-top h-24">
                                <div class="font-medium text-gray-700 mb-1">5</div>
                            </td>
                            <td class="py-1 px-2 border border-gray-200 align-top h-24">
                                <div class="font-medium text-gray-700 mb-1">6</div>
                                <div class="text-xs p-1 bg-green-100 text-green-700 rounded mb-1 truncate">アルゴリズム学習
                                </div>
                            </td>
                            <td class="py-1 px-2 border border-gray-200 align-top h-24">
                                <div class="font-medium text-blue-500 mb-1">7</div>
                            </td>
                        </tr>
                        <!-- 他の週も同様に -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- リストビュー -->
        <div x-show="activeTab === 'list'" class="bg-white rounded-xl shadow-md p-6 mb-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">今後のスケジュール</h2>

            <ul class="space-y-3">
                @foreach ($schedules as $schedule)
                    <li
                        class="p-4 border border-gray-200 rounded-lg hover:border-indigo-200 hover:bg-indigo-50 transition-colors shadow-sm bg-white flex justify-between items-center">
                        <div class="flex items-center">
                            <div
                                class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 mr-3">
                                <flux:icon.document-text class="w-5 h-5" />
                            </div>
                            <span>{{ $schedule }}</span>
                        </div>
                        <div class="flex space-x-2">
                            <button class="p-2 text-gray-500 hover:text-indigo-600 transition-colors">
                                <flux:icon.pencil-square class="w-5 h-5" />
                            </button>
                            <button class="p-2 text-gray-500 hover:text-red-600 transition-colors">
                                <flux:icon.trash class="w-5 h-5" />
                            </button>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- 進捗バーセクション -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">今月の学習進捗</h2>
            <div class="mb-6">
                <div class="flex justify-between mb-2">
                    <span class="text-gray-600 font-medium">過去問演習</span>
                    <span class="text-indigo-600 font-medium">75%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                    <div class="bg-indigo-600 h-2.5 rounded-full" style="width: 75%"></div>
                </div>
            </div>
            <div class="mb-6">
                <div class="flex justify-between mb-2">
                    <span class="text-gray-600 font-medium">模擬試験</span>
                    <span class="text-purple-600 font-medium">50%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                    <div class="bg-purple-600 h-2.5 rounded-full" style="width: 50%"></div>
                </div>
            </div>
            <div>
                <div class="flex justify-between mb-2">
                    <span class="text-gray-600 font-medium">アルゴリズム学習</span>
                    <span class="text-green-600 font-medium">30%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                    <div class="bg-green-600 h-2.5 rounded-full" style="width: 30%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- モーダルウィンドウ -->
    <template x-if="openModal">
        <div class="fixed inset-0 flex items-center justify-center z-50">
            <!-- 背景のオーバーレイ -->
            <div class="absolute inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm" @click="openModal = false"></div>
            <!-- モーダル本体 -->
            <div class="bg-white rounded-xl shadow-xl z-50 p-6 w-full max-w-md m-4 transform transition-all duration-300"
                x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
                <h2 class="text-xl font-bold mb-4 text-gray-800 flex items-center">
                    <span class="bg-indigo-100 text-indigo-600 p-1.5 rounded-lg mr-2">
                        <flux:icon.plus class="w-5 h-5" />
                    </span>
                    新しいスケジュール
                </h2>
                <div class="space-y-4">
                    <div>
                        <label for="scheduleTitle" class="block text-sm font-medium text-gray-700 mb-1">タイトル</label>
                        <input type="text" id="scheduleTitle" wire:model="newSchedule" placeholder="スケジュール内容"
                            class="w-full border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                    </div>
                    <div>
                        <label for="scheduleDate" class="block text-sm font-medium text-gray-700 mb-1">日付</label>
                        <input type="date" id="scheduleDate"
                            class="w-full border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                    </div>
                    <div>
                        <label for="scheduleCategory"
                            class="block text-sm font-medium text-gray-700 mb-1">カテゴリ</label>
                        <select id="scheduleCategory"
                            class="w-full border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                            <option value="study">学習</option>
                            <option value="exam">試験</option>
                            <option value="rest">休憩</option>
                        </select>
                    </div>
                    <div>
                        <label for="scheduleNotes" class="block text-sm font-medium text-gray-700 mb-1">メモ</label>
                        <textarea id="scheduleNotes" rows="3" placeholder="詳細メモ"
                            class="w-full border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"></textarea>
                    </div>
                </div>
                <div class="flex justify-end mt-6">
                    <button @click="openModal = false"
                        class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg mr-2 hover:bg-gray-100 transition-colors">
                        キャンセル
                    </button>
                    <button wire:click="addSchedule" @click="openModal = false"
                        class="px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-colors shadow-md">
                        追加
                    </button>
                </div>
            </div>
        </div>
    </template>
</div>
