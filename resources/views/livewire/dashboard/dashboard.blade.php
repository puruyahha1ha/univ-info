<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-800">
                こんにちは、{{ $user->name }}さん
            </h2>
            <p class="text-gray-600">今日も一緒に頑張りましょう！</p>
        </div>

        <!-- 学習統計 -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6 bg-white border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900 mb-4">この7日間の学習状況</h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="bg-indigo-50 rounded-lg p-4 text-center">
                        <div class="text-3xl font-bold text-indigo-600">{{ $studyStats['totalQuestions'] }}</div>
                        <div class="text-sm text-gray-600">解いた問題数</div>
                    </div>
                    <div class="bg-green-50 rounded-lg p-4 text-center">
                        <div class="text-3xl font-bold text-green-600">{{ $studyStats['correctRate'] }}%</div>
                        <div class="text-sm text-gray-600">正答率</div>
                    </div>
                    <div class="bg-yellow-50 rounded-lg p-4 text-center">
                        <div class="text-3xl font-bold text-yellow-600">
                            {{ $studyStats['studyTimeHours'] }}時間 {{ $studyStats['studyTimeMinutes'] }}分
                        </div>
                        <div class="text-sm text-gray-600">学習時間</div>
                    </div>
                    <div class="bg-purple-50 rounded-lg p-4 text-center">
                        <div class="text-3xl font-bold text-purple-600">{{ $upcomingEvents->count() }}</div>
                        <div class="text-sm text-gray-600">今後の学習予定</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- 弱点カテゴリ -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">重点対策が必要な分野</h3>
                    @if($weakCategories->count() > 0)
                        <ul class="space-y-3">
                            @foreach($weakCategories as $category)
                                <li class="flex items-center p-3 bg-red-50 rounded-lg">
                                    <div class="flex-1">
                                        <div class="font-medium">{{ $category->category->name }}</div>
                                        <div class="text-sm text-gray-600">正答率: {{ $category->correct_rate }}%</div>
                                    </div>
                                    <a href="{{ route('workbook') }}?category={{ $category->category_id }}" 
                                       class="px-3 py-1 bg-red-600 text-white rounded-full text-xs hover:bg-red-700 transition-colors"
                                       wire:navigate>
                                        今すぐ学習
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="text-center p-4 text-gray-500">
                            まだデータがありません。学習を続けると弱点分析が表示されます。
                        </div>
                    @endif
                </div>
            </div>

            <!-- 今後の学習予定 -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900">今後の学習予定</h3>
                        <a href="{{ route('schedule') }}" class="text-sm text-indigo-600 hover:text-indigo-800" wire:navigate>
                            予定表へ
                        </a>
                    </div>
                    @if($upcomingEvents->count() > 0)
                        <ul class="space-y-3">
                            @foreach($upcomingEvents as $event)
                                <li class="flex items-center p-3 bg-indigo-50 rounded-lg">
                                    <div class="flex-1">
                                        <div class="font-medium">{{ $event->title }}</div>
                                        <div class="text-sm text-gray-600">
                                            {{ $event->start_datetime->format('m/d H:i') }} - {{ $event->end_datetime->format('H:i') }}
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="text-center p-4 text-gray-500">
                            予定がありません。スケジュール管理から予定を追加してください。
                        </div>
                    @endif
                </div>
            </div>

            <!-- 最近の学習活動 -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900">最近の学習活動</h3>
                        <a href="{{ route('analysis') }}" class="text-sm text-indigo-600 hover:text-indigo-800" wire:navigate>
                            詳細分析へ
                        </a>
                    </div>
                    @if($recentActivity->count() > 0)
                        <ul class="space-y-3">
                            @foreach($recentActivity as $activity)
                                <li class="flex items-center p-3 rounded-lg {{ $activity->is_correct ? 'bg-green-50' : 'bg-red-50' }}">
                                    <div class="flex-1">
                                        <div class="font-medium">{{ $activity->question->title }}</div>
                                        <div class="text-sm text-gray-600">
                                            {{ $activity->study_datetime->format('m/d H:i') }}
                                            <span class="ml-2 px-2 py-0.5 rounded-full {{ $activity->is_correct ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $activity->is_correct ? '正解' : '不正解' }}
                                            </span>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="text-center p-4 text-gray-500">
                            まだ学習記録がありません。過去問を解くと記録が表示されます。
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- クイックアクセス -->
        <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900 mb-4">クイックアクセス</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <a href="{{ route('workbook') }}" class="flex flex-col items-center p-4 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition-colors" wire:navigate>
                        <div class="text-indigo-600 text-xl mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <div class="font-medium">過去問</div>
                    </a>
                    <a href="{{ route('schedule') }}" class="flex flex-col items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition-colors" wire:navigate>
                        <div class="text-green-600 text-xl mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="font-medium">スケジュール</div>
                    </a>
                    <a href="{{ route('analysis') }}" class="flex flex-col items-center p-4 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition-colors" wire:navigate>
                        <div class="text-yellow-600 text-xl mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <div class="font-medium">成績分析</div>
                    </a>
                    <a href="{{ route('profile.edit') }}" class="flex flex-col items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors" wire:navigate>
                        <div class="text-purple-600 text-xl mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="font-medium">プロフィール</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>