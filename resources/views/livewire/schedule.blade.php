<div class="max-w-3xl mx-auto p-6" x-data="{ openModal: false }">
    <h1 class="text-2xl font-bold mb-4">スケジュール管理</h1>

    <!-- スケジュール追加ボタン（モーダルを表示） -->
    <button @click="openModal = true" class="mb-4 bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
        スケジュール追加
    </button>

    <!-- モーダルウィンドウ -->
    <template x-if="openModal">
        <div class="fixed inset-0 flex items-center justify-center z-50">
            <!-- 背景のオーバーレイ -->
            <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
            <!-- モーダル本体 -->
            <div class="bg-white rounded-lg shadow-lg z-50 p-6 w-96">
                <h2 class="text-xl font-bold mb-4">新しいスケジュール</h2>
                <input type="text" wire:model="newSchedule" placeholder="スケジュール内容"
                    class="w-full border border-gray-300 p-2 rounded mb-4">
                <div class="flex justify-end">
                    <button @click="openModal = false" class="mr-2 text-gray-700">キャンセル</button>
                    <button wire:click="addSchedule" @click="openModal = false"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        追加
                    </button>
                </div>
            </div>
        </div>
    </template>

    <!-- カレンダーコンポーネント -->
    <div class="my-6">
        <h2 class="text-xl font-bold mb-2">カレンダー</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">日</th>
                        <th class="py-2 px-4 border-b">月</th>
                        <th class="py-2 px-4 border-b">火</th>
                        <th class="py-2 px-4 border-b">水</th>
                        <th class="py-2 px-4 border-b">木</th>
                        <th class="py-2 px-4 border-b">金</th>
                        <th class="py-2 px-4 border-b">土</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- サンプルとして1週間分を表示。実際はループなどで日付を動的に生成してください。 -->
                    <tr>
                        <td class="py-2 px-4 border-b text-center">1</td>
                        <td class="py-2 px-4 border-b text-center">2</td>
                        <td class="py-2 px-4 border-b text-center">3</td>
                        <td class="py-2 px-4 border-b text-center">4</td>
                        <td class="py-2 px-4 border-b text-center">5</td>
                        <td class="py-2 px-4 border-b text-center">6</td>
                        <td class="py-2 px-4 border-b text-center">7</td>
                    </tr>
                    <!-- 必要に応じて、複数の行を追加 -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- スケジュールリスト -->
    <ul class="space-y-3">
        @foreach ($schedules as $schedule)
            <li class="p-3 border rounded shadow-sm bg-white">
                {{ $schedule }}
            </li>
        @endforeach
    </ul>
</div>
