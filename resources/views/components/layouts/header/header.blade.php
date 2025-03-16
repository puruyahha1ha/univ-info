@props(['siteTitle' => 'サイトタイトル'])

<header x-data="{ open: false }"
    class="fixed md:relative top-0 left-0 w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white z-30 shadow-lg transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 py-3 md:py-4 flex items-center justify-between">
        {{-- ロゴやサイト名 --}}
        <div class="flex items-center space-x-2">
            <a href="/" class="text-xl font-bold flex items-center space-x-2">
                <flux:icon.globe-alt />
                <span>{{ $siteTitle }}</span>
            </a>
        </div>

        {{-- PC用メニュー --}}
        <x-layouts.header.desktop-nav />

        {{-- ハンバーガーボタン（SP用） --}}
        <x-layouts.header.mobile-hamburger />
    </div>

    {{-- モバイル用ドロワーメニュー --}}
    <x-layouts.header.mobile-drawer />
</header>
