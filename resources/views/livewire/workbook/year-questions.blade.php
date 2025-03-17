<div>
    <!-- 問題表示コンポーネント（Livewire用） -->
    <div class="max-w-5xl mx-auto py-8 px-4">
        <div class="mb-6 flex items-center justify-between">
            <div class="flex items-center">
                <a href="{{ route('workbook') }}"
                    class="flex items-center text-indigo-600 hover:text-indigo-800 transition-colors" wire:navigate>
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    過去問一覧に戻る
                </a>
            </div>
            <div class="flex items-center space-x-3">
                <span class="text-gray-600">問題 {{ $currentQuestionIndex + 1 }}/{{ count($questions) }}</span>
                <div class="w-32 bg-gray-200 rounded-full h-2">
                    <div class="bg-indigo-600 h-2 rounded-full"
                        style="width: {{ (($currentQuestionIndex + 1) / count($questions)) * 100 }}%"></div>
                </div>
            </div>
        </div>

        <!-- 問題カード -->
        <div class="bg-white rounded-xl shadow-lg p-6 md:p-8 mb-8">
            <!-- 問題タイトル -->
            <div class="flex justify-between items-center mb-6 pb-3 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-800">{{ $year }}年度 問{{ $currentQuestionIndex + 1 }}</h2>
                <div class="flex items-center">
                    <span class="bg-indigo-100 text-indigo-800 text-sm font-medium px-2.5 py-0.5 rounded">
                        {{ $currentQuestion['category'] }}
                    </span>
                    <div class="ml-2 text-gray-500 text-sm">
                        配点: {{ $currentQuestion['points'] }}点
                    </div>
                </div>
            </div>

            <!-- 問題文と図表 -->
            <div class="mb-8">
                <div class="prose max-w-none">
                    {!! $currentQuestion['question_text'] !!}
                </div>

                @if (isset($currentQuestion['image']))
                    <div class="mt-4 flex justify-center">
                        <img src="{{ asset($currentQuestion['image']) }}" alt="問題の図表"
                            class="max-w-full rounded-lg shadow">
                    </div>
                @endif
            </div>

            <!-- 選択肢 -->
            <div class="space-y-3 mb-8">
                <h3 class="font-semibold text-gray-800">選択肢</h3>
                @foreach ($currentQuestion['choices'] as $key => $choice)
                    <div class="p-4 border rounded-lg cursor-pointer transition-colors 
                    {{ $selectedAnswer === $key
                        ? ($showResult
                            ? ($key === $currentQuestion['correct_answer']
                                ? 'bg-green-100 border-green-300'
                                : 'bg-red-100 border-red-300')
                            : 'bg-indigo-100 border-indigo-300')
                        : 'hover:bg-gray-50' }}"
                        wire:click="selectAnswer('{{ $key }}')">
                        <div class="flex items-start">
                            <div
                                class="flex-shrink-0 w-6 h-6 rounded-full border-2 {{ $selectedAnswer === $key ? 'border-indigo-600 bg-indigo-600' : 'border-gray-300' }} flex items-center justify-center mr-3">
                                @if ($selectedAnswer === $key)
                                    <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                @endif
                            </div>
                            <span class="text-gray-800">{{ $key }}. {{ $choice }}</span>
                        </div>

                        @if ($showResult && $key === $currentQuestion['correct_answer'])
                            <div class="mt-2 text-green-600 flex items-center">
                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                正解
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- 解答結果と解説 -->
            @if ($showResult)
                <div class="mt-8 p-6 bg-gray-50 rounded-xl">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">解説</h3>
                    <div class="prose max-w-none">
                        {!! $currentQuestion['explanation'] !!}
                    </div>
                </div>
            @endif
        </div>

        <!-- ナビゲーションボタン -->
        <div class="flex justify-between">
            <button wire:click="previousQuestion"
                class="px-5 py-2.5 bg-gray-200 text-gray-700 rounded-lg font-medium hover:bg-gray-300 transition-colors {{ $currentQuestionIndex === 0 ? 'opacity-50 cursor-not-allowed' : '' }}"
                {{ $currentQuestionIndex === 0 ? 'disabled' : '' }}>
                前の問題
            </button>

            @if ($showResult)
                <button wire:click="nextQuestion"
                    class="px-5 py-2.5 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 transition-colors">
                    {{ $isLastQuestion ? '結果を見る' : '次の問題' }}
                </button>
            @else
                <button wire:click="checkAnswer"
                    class="px-5 py-2.5 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 transition-colors {{ !$selectedAnswer ? 'opacity-50 cursor-not-allowed' : '' }}"
                    {{ !$selectedAnswer ? 'disabled' : '' }}>
                    解答を確認
                </button>
            @endif
        </div>
    </div>
</div>
