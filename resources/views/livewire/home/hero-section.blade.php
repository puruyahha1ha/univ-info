<section class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-16 md:py-24 px-4 overflow-hidden relative">

    {{-- 背景の装飾要素 --}}
    <div class="absolute inset-0 overflow-hidden opacity-10">
        <div class="absolute -right-5 -top-5 w-40 h-40 bg-yellow-300 rounded-full"></div>
        <div class="absolute left-10 bottom-10 w-64 h-64 bg-indigo-300 rounded-full"></div>
        <div class="absolute right-1/4 bottom-1/3 w-20 h-20 bg-pink-300 rounded-full"></div>
    </div>

    <div class="max-w-7xl mx-auto relative">
        <div class="md:flex md:items-center md:justify-between">
            <div class="md:w-1/2 md:pr-8 mb-10 md:mb-0 text-center md:text-left">
                <h1 class="text-3xl md:text-5xl font-bold mb-6 leading-tight">
                    共通テスト「情報Ⅰ」<br class="hidden md:block">
                    <span class="text-yellow-300">合格への近道</span>
                </h1>
                <p class="text-lg md:text-xl mb-8 text-indigo-100 max-w-lg mx-auto md:mx-0">
                    スケジュール管理から過去問対策まで、あなたの合格を全力でサポートします。効率的な学習計画で目標達成へ。
                </p>
                <div
                    class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 justify-center md:justify-start">
                    <a href="{{ route('register') }}"
                        class="inline-block bg-yellow-400 text-indigo-900 font-semibold px-6 py-3 rounded-full shadow-lg hover:bg-yellow-300 transition-all transform hover:-translate-y-1 hover:shadow-xl">
                        無料会員登録
                    </a>
                    <a href="{{ route('login') }}"
                        class="inline-block bg-white bg-opacity-20 text-white font-semibold px-6 py-3 rounded-full shadow-lg hover:bg-opacity-30 transition-all transform hover:-translate-y-1 hover:shadow-xl"
                        wire:navigate>
                        ログイン
                    </a>
                </div>
            </div>
            <div class="md:w-1/2 md:pl-8 relative">
                <div
                    class="bg-white bg-opacity-10 rounded-2xl p-6 md:p-8 shadow-xl backdrop-filter backdrop-blur-sm border border-white border-opacity-20 transform rotate-1 hover:rotate-0 transition-transform duration-500">
                    <div class="flex items-center mb-6">
                        <div class="w-3 h-3 bg-red-400 rounded-full mr-2"></div>
                        <div class="w-3 h-3 bg-yellow-400 rounded-full mr-2"></div>
                        <div class="w-3 h-3 bg-green-400 rounded-full"></div>
                    </div>
                    <div class="space-y-3">
                        <div class="h-6 bg-white bg-opacity-20 rounded"></div>
                        <div class="h-6 bg-white bg-opacity-20 rounded w-3/4"></div>
                        <div class="h-6 bg-white bg-opacity-20 rounded w-5/6"></div>
                        <div class="h-6 bg-white bg-opacity-20 rounded w-2/3"></div>
                    </div>
                    <div class="mt-6 grid grid-cols-2 gap-3">
                        <div class="h-20 bg-white bg-opacity-20 rounded"></div>
                        <div class="h-20 bg-white bg-opacity-20 rounded"></div>
                        <div class="h-20 bg-white bg-opacity-20 rounded"></div>
                        <div class="h-20 bg-white bg-opacity-20 rounded"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 波形の装飾（下部） --}}
    <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-0 transform" style="transform: rotate(180deg)">
        <svg class="relative block w-full h-16 md:h-24" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path
                d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
                fill="#ffffff"></path>
        </svg>
    </div>
</section>
