<header x-data="{ open: false }"
    class="fixed md:relative top-0 left-0 w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white z-30 shadow-lg transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 py-3 md:py-4 flex items-center justify-between">
        {{-- ロゴやサイト名 --}}
        <div class="flex items-center space-x-2">
            <a href="#" class="text-xl font-bold flex items-center space-x-2">
                <flux:icon.globe-alt />
                <span>サイトタイトル</span>
            </a>
        </div>

        {{-- PC用メニュー --}}
        <nav class="hidden md:flex space-x-6 items-center">
            <a href="/" class="hover:text-yellow-300 transition-colors font-medium" wire:navigate>ホーム</a>
            <a href="/schedule" class="hover:text-yellow-300 transition-colors font-medium" wire:navigate>スケジュール</a>
            <a href="/workbook" class="hover:text-yellow-300 transition-colors font-medium" wire:navigate>過去問</a>
            <a href="#" class="hover:text-yellow-300 transition-colors font-medium">成績分析</a>
            @guest
                {{-- ログインボタン --}}
                <a href="{{ route('login') }}"
                    class="bg-white text-indigo-600 hover:bg-yellow-100 font-semibold rounded-full px-5 py-2 transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5"
                    wire:navigate>
                    ログイン
                </a>
            @endguest
            @auth
                {{-- ダッシュボードボタン --}}
                <a href="{{ route('dashboard') }}"
                    class="bg-yellow-400 text-indigo-800 hover:bg-yellow-300 font-semibold rounded-full px-5 py-2 transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    ダッシュボード
                </a>
            @endauth
        </nav>

        {{-- ハンバーガーボタン（SP用） --}}
        <button @click="open = !open"
            class="md:hidden focus:outline-none rounded-full p-2 hover:bg-indigo-500 transition-colors"
            aria-label="Toggle menu">
            <flux:icon.bars-3 />
        </button>
    </div>

    {{-- SP用: メニュー展開時のオーバーレイ --}}
    <div class="md:hidden fixed inset-0 bg-black bg-opacity-50 z-40 backdrop-blur-sm" x-show="open"
        x-transition.opacity @click="open = false"></div>

    {{-- SP用ドロワーメニュー（右からスライドイン） --}}
    <nav class="md:hidden fixed top-0 right-0 w-4/5 max-w-sm h-full bg-gradient-to-b from-indigo-600 to-purple-700 transform z-50 overflow-y-auto rounded-l-2xl shadow-2xl"
        :class="open ? 'translate-x-0' : 'translate-x-full'" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full">
        {{-- 閉じるボタン --}}
        <div class="relative pt-16 pb-4">
            <button @click="open = false"
                class="absolute top-4 right-4 text-white focus:outline-none bg-indigo-500 p-2 rounded-full hover:bg-indigo-400 transition-colors"
                aria-label="Close menu">
                <flux:icon.x-mark />
            </button>
        </div>

        {{-- メニュー項目 --}}
        <div class="px-6 pb-8 flex flex-col space-y-3">
            <a href="/"
                class="hover:bg-indigo-500 px-4 py-3 rounded-lg transition-colors flex items-center space-x-3"
                wire:navigate>
                <flux:icon.home />
                <span>ホーム</span>
            </a>
            <a href="/schedule"
                class="hover:bg-indigo-500 px-4 py-3 rounded-lg transition-colors flex items-center space-x-3"
                wire:navigate>
                <flux:icon.calendar />
                <span>スケジュール</span>
            </a>
            <a href="/workbook"
                class="hover:bg-indigo-500 px-4 py-3 rounded-lg transition-colors flex items-center space-x-3"
                wire:navigate>
                <flux:icon.book-open />
                <span>過去問</span>
            </a>
            <a href="/analysis"
                class="hover:bg-indigo-500 px-4 py-3 rounded-lg transition-colors flex items-center space-x-3">
                <flux:icon.chart-bar />
                <span>成績分析</span>
            </a>
            <div class="pt-4 border-t border-indigo-400"></div>
            @guest
                {{-- SP用 ログインボタン --}}
                <a href="{{ route('login') }}"
                    class="block bg-white text-indigo-600 hover:bg-gray-100 font-semibold rounded-lg px-4 py-3 transition-colors text-center shadow-md"
                    wire:navigate>
                    ログイン
                </a>
            @endguest
            @auth
                {{-- SP用 ダッシュボードボタン --}}
                <a href="{{ route('dashboard') }}"
                    class="block bg-yellow-400 text-indigo-800 hover:bg-yellow-300 font-semibold rounded-lg px-4 py-3 transition-colors text-center shadow-md">
                    ダッシュボード
                </a>
            @endauth
        </div>
    </nav>
</header>
