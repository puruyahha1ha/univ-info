<div>
    <section class="py-8 sm:py-12 px-4 bg-gray-50">
        <div class="max-w-4xl mx-auto">
            <!-- Question Header -->
            <div class="mb-6 sm:mb-8">
                <div class="flex justify-between items-center mb-4">
                    <div class="flex items-center space-x-2">
                        <span
                            class="px-2 py-1 inline-flex text-xs leading-4 font-semibold rounded-full bg-blue-100 text-blue-800">
                            {{ $question->category }}
                        </span>
                        <span class="text-yellow-500 text-sm">
                            {{ str_repeat('★', $question->difficulty) }}
                        </span>
                    </div>
                    <div class="text-sm text-gray-500">
                        {{ $question->year }}年度 / {{ $question->points }}点
                    </div>
                </div>

                <!-- Question Text -->
                <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6">
                    <h2 class="text-lg sm:text-xl font-bold text-gray-800 mb-4">
                        問題
                    </h2>
                    <div class="prose prose-sm sm:prose-base max-w-none">
                        {!! $question->question_text !!}
                    </div>

                    <!-- Optional Image -->
                    @if ($question->image_path)
                        <div class="mt-4 text-center">
                            <img src="{{ Storage::url($question->image_path) }}" alt="問題の画像"
                                class="max-w-full mx-auto rounded-lg shadow-md">
                        </div>
                    @endif
                </div>
            </div>

            <!-- Answers Section -->
            <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6 mt-4">
                <h3 class="text-md sm:text-lg font-medium text-gray-900 mb-4">
                    解答を選択してください
                </h3>

                <div class="space-y-3">
                    @foreach ($answers as $answer)
                        <div wire:click="selectAnswer({{ $answer->id }})"
                            class="cursor-pointer rounded-lg p-3 border transition-all duration-300 
                                {{ !$isSubmitted
                                    ? ($selectedAnswer == $answer->id
                                        ? 'bg-blue-50 border-blue-300'
                                        : 'hover:bg-gray-50 border-gray-200')
                                    : ($answer->is_correct
                                        ? 'bg-green-50 border-green-300'
                                        : ($userAnswer == $answer->id
                                            ? 'bg-red-50 border-red-300'
                                            : 'border-gray-200')) }}
                            ">
                            <div class="flex items-center">
                                <div class="mr-3">
                                    <input type="radio" wire:model="selectedAnswer" value="{{ $answer->id }}"
                                        {{ $isSubmitted ? 'disabled' : '' }} class="form-radio text-blue-600">
                                </div>
                                <div class="flex-1">
                                    <div class="text-sm text-gray-800">
                                        {!! $answer->answer_text !!}
                                    </div>
                                </div>

                                @if ($isSubmitted)
                                    <div class="ml-auto">
                                        @if ($answer->is_correct)
                                            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        @elseif($userAnswer == $answer->id)
                                            <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    @if (!$isSubmitted)
                        <button wire:click="submitAnswer" {{ $selectedAnswer ? '' : 'disabled' }}
                            class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 transition-colors 
                                {{ $selectedAnswer ? '' : 'opacity-50 cursor-not-allowed' }}">
                            解答を提出
                        </button>
                    @endif
                </div>

                <!-- Result Section -->
                @if ($isSubmitted)
                    <div
                        class="mt-6 p-4 rounded-lg 
                        {{ $isCorrect ? 'bg-green-50 border-green-200' : 'bg-red-50 border-red-200' }}">
                        <div class="flex items-center justify-between">
                            <h4
                                class="font-bold 
                                {{ $isCorrect ? 'text-green-800' : 'text-red-800' }}">
                                {{ $isCorrect ? '正解！' : '不正解' }}
                            </h4>

                            <button wire:click="toggleHint"
                                class="text-sm text-indigo-600 hover:text-indigo-800 transition-colors">
                                {{ $showHint ? '解説を隠す' : '解説を表示' }}
                            </button>
                        </div>

                        @if ($showHint)
                            <div class="mt-4 prose prose-sm max-w-none text-gray-700">
                                <h5 class="text-md font-semibold mb-2">解説</h5>
                                {!! $question->explanation !!}
                            </div>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Navigation Buttons -->
            <div class="mt-6 flex justify-between">
                <a href="{{ route('workbook.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    問題一覧に戻る
                </a>

                <a href="#" wire:click.prevent="$dispatch('next-question')"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors">
                    次の問題
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>
</div>
