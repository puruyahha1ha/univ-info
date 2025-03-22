@push('styles')
    @vite('resources/css/schedule.css')
@endpush

@push('scripts')
    @vite('resources/js/schedule.js')
@endpush

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">スケジュール管理</h2>
                    <div class="mt-4 md:mt-0 flex space-x-2">
                        <button
                            class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition-colors"
                            wire:click="$toggle('showEventModal')"
                        >
                            <span class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                予定を追加
                            </span>
                        </button>
                    </div>
                </div>

                <!-- カレンダーコントロール -->
                <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                    <div class="flex items-center space-x-4 mb-4 md:mb-0">
                        <button 
                            class="p-2 rounded-full hover:bg-gray-100"
                            wire:click="prevPeriod"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        
                        <h3 class="text-xl font-semibold text-gray-800 w-48 text-center">
                            {{ $currentDateDisplay }}
                        </h3>
                        
                        <button 
                            class="p-2 rounded-full hover:bg-gray-100"
                            wire:click="nextPeriod"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                        
                        <button
                            class="px-3 py-1 bg-gray-100 rounded-md hover:bg-gray-200 text-sm"
                            wire:click="today"
                        >
                            今日
                        </button>
                    </div>
                    
                    <div class="flex space-x-2 border rounded-md overflow-hidden">
                        <button
                            class="px-4 py-2 {{ $viewMode === 'month' ? 'bg-indigo-600 text-white' : 'hover:bg-gray-100' }}"
                            wire:click="changeView('month')"
                        >
                            月
                        </button>
                        <button
                            class="px-4 py-2 {{ $viewMode === 'week' ? 'bg-indigo-600 text-white' : 'hover:bg-gray-100' }}"
                            wire:click="changeView('week')"
                        >
                            週
                        </button>
                        <button
                            class="px-4 py-2 {{ $viewMode === 'day' ? 'bg-indigo-600 text-white' : 'hover:bg-gray-100' }}"
                            wire:click="changeView('day')"
                        >
                            日
                        </button>
                    </div>
                </div>

                <!-- カレンダー(月表示) -->
                @if ($viewMode === 'month')
                <div class="bg-white rounded-lg border shadow overflow-hidden">
                    <!-- 曜日ヘッダー -->
                    <div class="grid grid-cols-7 bg-gray-50">
                        @foreach (['日', '月', '火', '水', '木', '金', '土'] as $dayOfWeek)
                            <div class="py-2 text-center {{ $dayOfWeek === '日' ? 'text-red-600' : ($dayOfWeek === '土' ? 'text-blue-600' : '') }}">
                                {{ $dayOfWeek }}
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- 日付グリッド -->
                    <div class="grid grid-cols-7 border-t">
                        @php
                            $startOfMonth = \Carbon\Carbon::parse($currentDate)->startOfMonth();
                            $endOfMonth = \Carbon\Carbon::parse($currentDate)->endOfMonth();
                            $startOfCalendar = $startOfMonth->copy()->startOfWeek(\Carbon\Carbon::SUNDAY);
                            $endOfCalendar = $endOfMonth->copy()->endOfWeek(\Carbon\Carbon::SATURDAY);
                            $day = $startOfCalendar->copy();
                        @endphp
                        
                        @while ($day <= $endOfCalendar)
                            @php
                                $isToday = $day->isToday();
                                $isCurrentMonth = $day->month === $startOfMonth->month;
                                $dayEvents = collect($events)->filter(function($event) use ($day) {
                                    return \Carbon\Carbon::parse($event['start'])->format('Y-m-d') === $day->format('Y-m-d');
                                })->take(3);
                                $moreEvents = collect($events)->filter(function($event) use ($day) {
                                    return \Carbon\Carbon::parse($event['start'])->format('Y-m-d') === $day->format('Y-m-d');
                                })->count() - 3;
                            @endphp
                            
                            <div 
                                class="min-h-[120px] border-b border-r p-1 {{ $isCurrentMonth ? '' : 'bg-gray-50' }} {{ $isToday ? 'bg-indigo-50' : '' }}"
                                wire:click="selectDate('{{ $day->format('Y-m-d') }}')"
                            >
                                <div class="flex justify-between items-center mb-1">
                                    <span class="text-sm font-medium {{ $day->dayOfWeek === 0 ? 'text-red-600' : ($day->dayOfWeek === 6 ? 'text-blue-600' : '') }} {{ $isToday ? 'bg-indigo-600 text-white rounded-full w-6 h-6 flex items-center justify-center' : '' }}">
                                        {{ $day->day }}
                                    </span>
                                    <span class="text-xs text-gray-500">
                                        @if ($isToday)
                                            今日
                                        @endif
                                    </span>
                                </div>
                                
                                <!-- 予定表示 -->
                                <div class="space-y-1">
                                    @foreach($dayEvents as $event)
                                        <div 
                                            class="text-xs p-1 rounded truncate cursor-pointer {{ $event['status'] === 'completed' ? 'bg-green-100 text-green-800' : 'bg-indigo-100 text-indigo-800' }}"
                                            wire:click.stop="editEvent({{ $event['id'] }})"
                                        >
                                            {{ \Carbon\Carbon::parse($event['start'])->format('H:i') }} {{ $event['title'] }}
                                        </div>
                                    @endforeach
                                    
                                    @if ($moreEvents > 0)
                                        <div class="text-xs text-gray-500 pl-1">
                                            他 {{ $moreEvents }} 件
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            @php
                                $day->addDay();
                            @endphp
                        @endwhile
                    </div>
                </div>
                @endif

                <!-- カレンダー(週表示) -->
                @if ($viewMode === 'week')
                <div class="bg-white rounded-lg border shadow overflow-hidden">
                    <!-- 曜日ヘッダー -->
                    <div class="grid grid-cols-8 bg-gray-50">
                        <div class="py-2 text-center border-r"></div>
                        @php
                            $startOfWeek = \Carbon\Carbon::parse($currentDate)->startOfWeek(\Carbon\Carbon::SUNDAY);
                            $day = $startOfWeek->copy();
                        @endphp
                        @for ($i = 0; $i < 7; $i++)
                            @php
                                $isToday = $day->isToday();
                            @endphp
                            <div class="py-2 text-center {{ $day->dayOfWeek === 0 ? 'text-red-600' : ($day->dayOfWeek === 6 ? 'text-blue-600' : '') }}">
                                <div>{{ ['日', '月', '火', '水', '木', '金', '土'][$day->dayOfWeek] }}</div>
                                <div class="{{ $isToday ? 'bg-indigo-600 text-white rounded-full w-6 h-6 flex items-center justify-center mx-auto' : '' }}">
                                    {{ $day->day }}
                                </div>
                            </div>
                            @php
                                $day->addDay();
                            @endphp
                        @endfor
                    </div>
                    
                    <!-- 時間スロット -->
                    <div class="grid grid-cols-8 border-t">
                        @for ($hour = 6; $hour < 22; $hour++)
                            <div class="h-12 border-b text-xs text-gray-500 flex items-center justify-center">
                                {{ $hour }}:00
                            </div>
                            
                            @php
                                $day = $startOfWeek->copy();
                            @endphp
                            @for ($i = 0; $i < 7; $i++)
                                @php
                                    $currentSlot = $day->copy()->hour($hour);
                                    $isToday = $day->isToday();
                                    $slotEvents = collect($events)->filter(function($event) use ($currentSlot) {
                                        $start = \Carbon\Carbon::parse($event['start']);
                                        $end = \Carbon\Carbon::parse($event['end']);
                                        return $start->format('Y-m-d') === $currentSlot->format('Y-m-d') 
                                            && $start->hour <= $currentSlot->hour 
                                            && $end->hour > $currentSlot->hour;
                                    });
                                @endphp
                                
                                <div 
                                    class="h-12 border-b border-r {{ $isToday ? 'bg-indigo-50' : '' }}"
                                    wire:click="selectDate('{{ $day->format('Y-m-d') }}')"
                                >
                                    @foreach($slotEvents as $event)
                                        <div 
                                            class="text-xs p-1 rounded truncate cursor-pointer {{ $event['status'] === 'completed' ? 'bg-green-100 text-green-800' : 'bg-indigo-100 text-indigo-800' }}"
                                            wire:click.stop="editEvent({{ $event['id'] }})"
                                        >
                                            {{ \Carbon\Carbon::parse($event['start'])->format('H:i') }} {{ $event['title'] }}
                                        </div>
                                    @endforeach
                                </div>
                                
                                @php
                                    $day->addDay();
                                @endphp
                            @endfor
                        @endfor
                    </div>
                </div>
                @endif

                <!-- カレンダー(日表示) -->
                @if ($viewMode === 'day')
                <div class="bg-white rounded-lg border shadow overflow-hidden">
                    <!-- 時間スロット -->
                    <div class="grid grid-cols-1">
                        @for ($hour = 6; $hour < 22; $hour++)
                            @php
                                $currentSlot = \Carbon\Carbon::parse($currentDate)->hour($hour);
                                $slotEvents = collect($events)->filter(function($event) use ($currentSlot) {
                                    $start = \Carbon\Carbon::parse($event['start']);
                                    $end = \Carbon\Carbon::parse($event['end']);
                                    return $start->format('Y-m-d') === $currentSlot->format('Y-m-d') 
                                        && $start->hour <= $currentSlot->hour 
                                        && $end->hour > $currentSlot->hour;
                                });
                            @endphp
                            
                            <div class="flex border-b group hover:bg-gray-50 cursor-pointer"
                                 wire:click="selectDate('{{ $currentDate->format('Y-m-d') }}')">
                                <div class="w-20 flex-shrink-0 text-xs text-gray-500 p-2 border-r">
                                    {{ $hour }}:00 - {{ $hour+1 }}:00
                                </div>
                                
                                <div class="flex-grow p-2">
                                    @foreach($slotEvents as $event)
                                        <div 
                                            class="mb-1 p-2 rounded truncate {{ $event['status'] === 'completed' ? 'bg-green-100 text-green-800' : 'bg-indigo-100 text-indigo-800' }}"
                                            wire:click.stop="editEvent({{ $event['id'] }})"
                                        >
                                            <div class="font-medium">{{ $event['title'] }}</div>
                                            <div class="text-xs">
                                                {{ \Carbon\Carbon::parse($event['start'])->format('H:i') }} - 
                                                {{ \Carbon\Carbon::parse($event['end'])->format('H:i') }}
                                            </div>
                                        </div>
                                    @endforeach
                                    
                                    @if ($slotEvents->count() === 0)
                                        <div class="h-full w-full flex items-center justify-center text-gray-400 text-sm opacity-0 group-hover:opacity-100">
                                            + クリックで予定追加
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- 予定追加/編集モーダル -->
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50"
         x-data
         x-show="$wire.showEventModal"
         x-cloak
         x-on:keydown.escape.window="$wire.showEventModal = false">
        
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 overflow-hidden"
             x-on:click.outside="$wire.showEventModal = false">
            
            <div class="bg-indigo-600 text-white px-6 py-4 flex justify-between items-center">
                <h3 class="text-lg font-medium">
                    {{ $eventId ? '予定を編集' : '新しい予定' }}
                </h3>
                <button wire:click="$toggle('showEventModal')" class="text-white hover:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <div class="p-6">
                <form wire:submit.prevent="{{ $eventId ? 'updateEvent' : 'createEvent' }}">
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">タイトル</label>
                        <input type="text" id="title" wire:model="title" required
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        @error('title') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="startDateTime" class="block text-sm font-medium text-gray-700 mb-1">開始日時</label>
                            <input type="datetime-local" id="startDateTime" wire:model="startDateTime" required
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            @error('startDateTime') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>
                        
                        <div>
                            <label for="endDateTime" class="block text-sm font-medium text-gray-700 mb-1">終了日時</label>
                            <input type="datetime-local" id="endDateTime" wire:model="endDateTime" required
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            @error('endDateTime') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-1">内容</label>
                        <textarea id="content" wire:model="content" rows="3"
                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="repeatType" class="block text-sm font-medium text-gray-700 mb-1">繰り返し</label>
                            <select id="repeatType" wire:model="repeatType"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="none">繰り返しなし</option>
                                <option value="daily">毎日</option>
                                <option value="weekly">毎週</option>
                                <option value="monthly">毎月</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="notificationMinutes" class="block text-sm font-medium text-gray-700 mb-1">通知</label>
                            <select id="notificationMinutes" wire:model="notificationMinutes"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">通知なし</option>
                                <option value="5">5分前</option>
                                <option value="10">10分前</option>
                                <option value="15">15分前</option>
                                <option value="30">30分前</option>
                                <option value="60">1時間前</option>
                                <option value="1440">1日前</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <label for="learningMethod" class="block text-sm font-medium text-gray-700 mb-1">学習方法</label>
                        <select id="learningMethod" wire:model="learningMethod"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="">選択なし</option>
                            <option value="pomodoro">ポモドーロテクニック</option>
                            <option value="spaced_repetition">反復学習</option>
                            <option value="intensive">短期集中学習</option>
                            <option value="output_focused">アウトプット中心学習</option>
                        </select>
                        
                        @if($learningMethod)
                            <div class="mt-2 p-3 bg-indigo-50 rounded-md text-sm">
                                @if($learningMethod === 'pomodoro')
                                    <p><span class="font-medium">ポモドーロテクニック</span>: 25分の集中作業と5分の休憩を繰り返す方法です。4セット終了後に長めの休憩を取ります。</p>
                                @elseif($learningMethod === 'spaced_repetition')
                                    <p><span class="font-medium">反復学習</span>: 一定の間隔をあけて繰り返し学習する方法です。記憶の定着に効果的です。</p>
                                @elseif($learningMethod === 'intensive')
                                    <p><span class="font-medium">短期集中学習</span>: 短期間に集中して学習する方法です。試験直前の詰め込み学習に適しています。</p>
                                @elseif($learningMethod === 'output_focused')
                                    <p><span class="font-medium">アウトプット中心学習</span>: 学んだ内容を自分の言葉で説明したり問題を解いたりする方法です。理解度を深めるのに効果的です。</p>
                                @endif
                            </div>
                        @endif
                    </div>
                    
                    <div class="flex justify-between">
                        <div>
                            @if($eventId)
                                <button type="button" wire:click="deleteEvent"
                                        class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    削除
                                </button>
                            @endif
                        </div>
                        
                        <div class="flex space-x-3">
                            <button type="button" wire:click="$toggle('showEventModal')"
                                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                キャンセル
                            </button>
                            
                            <button type="submit"
                                    class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                {{ $eventId ? '更新' : '追加' }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>