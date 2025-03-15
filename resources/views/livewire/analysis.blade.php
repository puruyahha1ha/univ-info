<!-- 科目別スコア -->
<div class="bg-white rounded-xl shadow-md p-6">
    <h2 class="text-lg font-bold text-gray-800 mb-6">科目別スコア</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div>
            <!-- 円グラフの代わり -->
            <div class="relative w-48 h-48 mx-auto">
                <div class="absolute inset-0 rounded-full border-8 border-indigo-100"></div>
                <div
                    class="absolute inset-0 rounded-full border-8 border-transparent border-t-indigo-500 border-r-indigo-500 border-b-indigo-500 transform rotate-45">
                </div>
                <div class="absolute inset-0 flex items-center justify-center flex-col">
                    <span class="text-3xl font-bold text-gray-800">76%</span>
                    <span class="text-sm text-gray-500">総合正答率</span>
                </div>
            </div>
        </div>
        <div>
            <div class="space-y-4">
                @php
                    $subjectScores = [
                        ['name' => 'アルゴリズム', 'percentage' => 85, 'status' => 'green'],
                        ['name' => 'データベース', 'percentage' => 63, 'status' => 'yellow'],
                        ['name' => 'ネットワーク', 'percentage' => 42, 'status' => 'red'],
                        ['name' => 'セキュリティ', 'percentage' => 56, 'status' => 'orange'],
                        ['name' => 'プログラミング', 'percentage' => 92, 'status' => 'green'],
                    ];
                @endphp

                @foreach ($subjectScores as $subject)
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm text-gray-700">{{ $subject['name'] }}</span>
                            <span
                                class="text-{{ $subject['status'] }}-600 font-medium">{{ $subject['percentage'] }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-{{ $subject['status'] }}-500 h-2.5 rounded-full"
                                style="width: {{ $subject['percentage'] }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- 比較メトリクス（オプション） -->
            <div class="space-y-4 mt-6">
                @php
                    $comparisonMetrics = [
                        [
                            'name' => '総合スコア',
                            'yours' => '76点',
                            'average' => '68点',
                            'difference' => '+8点',
                            'yours_width' => '8%',
                            'average_width' => '68%',
                        ],
                        [
                            'name' => '偏差値',
                            'yours' => '63.2',
                            'average' => '',
                            'difference' => '',
                            'yours_width' => '63.2%',
                        ],
                        [
                            'name' => '問題解答数',
                            'yours' => '237問',
                            'average' => '185問',
                            'difference' => '+52問',
                            'yours_width' => '14%',
                            'average_width' => '50%',
                        ],
                    ];
                @endphp

                @foreach ($comparisonMetrics as $metric)
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-gray-700">{{ $metric['name'] }}</span>
                            @if (!empty($metric['average']))
                                <div>
                                    <span class="text-indigo-600 font-medium">{{ $metric['yours'] }}</span>
                                    <span class="text-gray-500 mx-1">/</span>
                                    <span class="text-red-600 font-medium">{{ $metric['average'] }}</span>
                                </div>
                            @else
                                <span class="text-indigo-600 font-medium">{{ $metric['yours'] }}</span>
                            @endif
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5 flex">
                            @if (!empty($metric['average']))
                                <div class="bg-red-500 h-2.5 rounded-l-full"
                                    style="width: {{ $metric['average_width'] }}"></div>
                                <div class="bg-indigo-500 h-2.5 rounded-r-full"
                                    style="width: {{ $metric['yours_width'] }}"></div>
                            @else
                                <div class="bg-indigo-500 h-2.5 rounded-full"
                                    style="width: {{ $metric['yours_width'] }}"></div>
                            @endif
                        </div>
                        @if (!empty($metric['difference']))
                            <div class="text-xs text-right mt-1 text-green-600">
                                {{ $metric['difference'] }}
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
