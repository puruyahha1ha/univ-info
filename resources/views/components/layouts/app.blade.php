<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-100 font-sans">
    <header x-data="{ open: false }"
        class="fixed md:relative top-0 left-0 w-full bg-blue-800 text-white z-30 h-16 shadow-md">
        <div class="max-w-7xl mx-auto px-4 h-full flex items-center justify-between">
            <!-- ロゴやサイト名 -->
            <div class="flex items-center space-x-2">
                <a href="#" class="text-xl font-bold">サイトタイトル</a>
            </div>

            <!-- PC用メニュー -->
            <nav class="hidden md:flex space-x-6 items-center">
                <a href="/" class="hover:underline" wire:navigate>ホーム</a>
                <a href="#" class="hover:underline">スケジュール</a>
                <a href="/workbook" class="hover:underline" wire:navigate>過去問</a>
                <a href="#" class="hover:underline">成績分析</a>
                @guest
                    <!-- ログインボタン -->
                    <a href="{{ route('login') }}"
                        class="bg-white text-blue-800 hover:bg-gray-100 font-semibold rounded px-4 py-2 transition-colors"
                        wire:navigate>
                        ログイン
                    </a>
                @endguest
                @auth
                    <!-- ダッシュボードボタン -->
                    <a href="{{ route('dashboard') }}"
                        class="bg-yellow-500 text-white hover:bg-yellow-600 font-semibold rounded px-4 py-2 transition-colors">
                        ダッシュボード
                    </a>
                @endauth
            </nav>

            <!-- ハンバーガーボタン（SP用） -->
            <button @click="open = !open" class="md:hidden focus:outline-none" aria-label="Toggle menu">
                <flux:icon.bars-3 />
            </button>
        </div>

        <!-- SP用: メニュー展開時のオーバーレイ（背景をクリックで閉じる） -->
        <div class="md:hidden fixed inset-0 bg-black bg-opacity-50 z-40" x-show="open" x-transition.opacity
            @click="open = false"></div>

        <!-- SP用ドロワーメニュー（右からスライドイン） -->
        <nav class="md:hidden fixed top-0 right-0 w-3/4 max-w-sm h-full bg-blue-800 transform z-50 overflow-y-auto"
            :class="open ? 'translate-x-0' : 'translate-x-full'" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full">
            <!-- 閉じるボタン -->
            <div class="relative pt-16 pb-2">
                <button @click="open = false" class="absolute top-4 right-4 text-white focus:outline-none"
                    aria-label="Close menu">
                    <flux:icon.x-mark />
                </button>
            </div>

            <!-- メニュー項目 -->
            <div class="px-4 pb-8 flex flex-col space-y-2">
                <a href="/" class="block hover:bg-blue-700 px-3 py-2 rounded" wire:navigate>ホーム</a>
                <a href="#" class="block hover:bg-blue-700 px-3 py-2 rounded">スケジュール</a>
                <a href="/workbook" class="block hover:bg-blue-700 px-3 py-2 rounded" wire:navigate>過去問</a>
                <a href="#" class="block hover:bg-blue-700 px-3 py-2 rounded">成績分析</a>
                @guest
                    <!-- SP用 ログインボタン -->
                    <a href="{{ route('login') }}"
                        class="block bg-white text-blue-800 hover:bg-gray-100 font-semibold rounded px-3 py-2 transition-colors"
                        wire:navigate>
                        ログイン
                    </a>
                @endguest
                @auth
                    <!-- SP用 ダッシュボードボタン -->
                    <a href="{{ route('dashboard') }}"
                        class="block bg-yellow-500 text-white hover:bg-yellow-600 font-semibold rounded px-3 py-2 transition-colors">
                        ダッシュボード
                    </a>
                @endauth
            </div>
        </nav>
    </header>
    <!-- メインコンテンツ -->
    <main class="mt-16 md:mt-0">
        {{ $slot }}
    </main>

    <!-- フッター -->
    <!-- PC版フッター -->
    <footer class="hidden md:block bg-blue-800 text-white py-6">
        <div class="max-w-7xl mx-auto px-4 text-center">
            &copy; {{ date('Y') }} サイトタイトル. All rights reserved.
        </div>
    </footer>

    <!-- SP版モバイルフッター -->
    <footer class="fixed bottom-0 left-0 w-full bg-blue-800 text-white md:hidden">
        <div class="max-w-7xl mx-auto flex justify-around items-center py-2">
            <a href="/" class="flex flex-col items-center" wire:navigate>
                <flux:icon.home />
                <span class="text-xs">ホーム</span>
            </a>
            <a href="/workbook" class="flex flex-col items-center" wire:navigate>
                <flux:icon.book-open />
                <span class="text-xs">過去問</span>
            </a>
            <a href="#" class="flex flex-col items-center">
                <flux:icon.calendar />
                <span class="text-xs">カレンダー</span>
            </a>
            <a href="#" class="flex flex-col items-center">
                <flux:icon.user-circle />
                <span class="text-xs">プロフィール</span>
            </a>
        </div>
    </footer>
</body>

</html>
