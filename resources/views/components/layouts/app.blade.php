<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxAppearance
</head>

<body>
    <header x-data="{ open: false }" class="fixed md:relative top-0 left-0 w-full bg-blue-800 text-white z-30 h-16">
        <div class="max-w-7xl mx-auto px-4 h-full flex items-center justify-between">
            <!-- ロゴやサイト名 -->
            <div class="flex items-center space-x-2">
                <a href="#" class="text-xl font-bold">サイトタイトル</a>
            </div>

            <!-- PC用メニュー -->
            <nav class="hidden md:flex space-x-6">
                <a href="/" class="hover:underline" wire:navigate>ホーム</a>
                <a href="#" class="hover:underline">スケジュール</a>
                <a href="/workbook" class="hover:underline" wire:navigate>過去問</a>
                <a href="#" class="hover:underline">成績分析</a>
                @guest
                    <a href="{{ route('login') }}" class="hover:underline">ログイン</a>
                @endguest
                @auth
                    <a href="{{ route('dashboard') }}" class="hover:underline">ダッシュボード</a>
                @endauth
            </nav>

            <!-- ハンバーガーボタン（SP用） -->
            <button @click="open = !open" class="md:hidden focus:outline-none" aria-label="Toggle menu">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
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
                <!-- 「閉じる」ボタンを右上に配置 -->
                <button @click="open = false" class="absolute top-4 right-4 text-white focus:outline-none"
                    aria-label="Close menu">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- メニュー項目 -->
            <div class="px-4 pb-8 flex flex-col space-y-2">
                <a href="/" class="block hover:bg-blue-700 px-3 py-2 rounded" wire:navigate>ホーム</a>
                <a href="#" class="block hover:bg-blue-700 px-3 py-2 rounded">スケジュール</a>
                <a href="/workbook" class="block hover:bg-blue-700 px-3 py-2 rounded" wire:navigate>過去問</a>
                <a href="#" class="block hover:bg-blue-700 px-3 py-2 rounded">成績分析</a>
                @guest
                    <a href="{{ route('login') }}" class="block hover:bg-blue-700 px-3 py-2 rounded">ログイン</a>
                @endguest
                @auth
                    <a href="{{ route('dashboard') }}" class="block hover:bg-blue-700 px-3 py-2 rounded">ダッシュボード</a>
                @endauth
            </div>
        </nav>
    </header>
    {{-- メインコンテンツ --}}
    <main class="mt-16 md:mt-0">
        {{ $slot }}
    </main>

    {{-- フッター --}}
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
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                <span class="text-xs">ホーム</span>
            </a>
            <a href="/workbook" class="flex flex-col items-center" wire:navigate>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-list-ol" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5" />
                    <path
                        d="M1.713 11.865v-.474H2c.217 0 .363-.137.363-.317 0-.185-.158-.31-.361-.31-.223 0-.367.152-.373.31h-.59c.016-.467.373-.787.986-.787.588-.002.954.291.957.703a.595.595 0 0 1-.492.594v.033a.615.615 0 0 1 .569.631c.003.533-.502.8-1.051.8-.656 0-1-.37-1.008-.794h.582c.008.178.186.306.422.309.254 0 .424-.145.422-.35-.002-.195-.155-.348-.414-.348h-.3zm-.004-4.699h-.604v-.035c0-.408.295-.844.958-.844.583 0 .96.326.96.756 0 .389-.257.617-.476.848l-.537.572v.03h1.054V9H1.143v-.395l.957-.99c.138-.142.293-.304.293-.508 0-.18-.147-.32-.342-.32a.33.33 0 0 0-.342.338zM2.564 5h-.635V2.924h-.031l-.598.42v-.567l.629-.443h.635z" />
                </svg>
                <span class="text-xs">過去問</span>
            </a>
            <a href="#" class="flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                </svg>
                <span class="text-xs">カレンダー</span>
            </a>
            <a href="#" class="flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mb-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span class="text-xs">通知</span>
            </a>
            <a href="#" class="flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
                <span class="text-xs">プロフィール</span>
            </a>
        </div>
    </footer>

    @fluxScripts
</body>

</html>
