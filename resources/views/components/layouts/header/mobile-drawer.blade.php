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
        <x-layouts.header.nav-item url="/" label="ホーム" icon="home" :mobile="true" :navigate="true" />

        <x-layouts.header.nav-item url="/workbook" label="過去問" icon="book-open" :mobile="true" :navigate="true" />
        
        <x-layouts.header.nav-item url="/schedule" label="スケジュール" icon="calendar" :mobile="true" :navigate="true" />

        <x-layouts.header.nav-item url="/analysis" label="成績分析" icon="chart-bar" :mobile="true" :navigate="true" />

        <div class="pt-4 border-t border-indigo-400"></div>

        <x-layouts.header.auth-button display="mobile" />
    </div>
</nav>
