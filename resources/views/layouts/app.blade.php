<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '共通テスト「情報１」学習サイト') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=noto-sans-jp:400,500,600,700" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- AlpineJS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.6/dist/cdn.min.js"></script>
    
    <!-- Livewire Styles and Scripts -->
    @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen">
        <livewire:layout.navigation />

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
        
        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="md:flex md:justify-between">
                    <div class="mb-6 md:mb-0">
                        <h2 class="text-xl font-bold mb-3">共通テスト「情報１」学習サイト</h2>
                        <p class="text-gray-400">効率的な学習で合格を目指しましょう</p>
                    </div>
                    <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-400 uppercase mb-2">学習コンテンツ</h3>
                            <ul class="text-gray-300">
                                <li class="mb-2">
                                    <a href="{{ route('workbook') }}" class="hover:underline" wire:navigate>過去問一問一答</a>
                                </li>
                                <li class="mb-2">
                                    <a href="{{ route('schedule') }}" class="hover:underline" wire:navigate>スケジュール管理</a>
                                </li>
                                <li>
                                    <a href="{{ route('analysis') }}" class="hover:underline" wire:navigate>成績分析</a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-400 uppercase mb-2">アカウント</h3>
                            <ul class="text-gray-300">
                                <li class="mb-2">
                                    <a href="{{ route('profile.edit') }}" class="hover:underline" wire:navigate>プロフィール</a>
                                </li>
                                @auth
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="hover:underline">ログアウト</button>
                                        </form>
                                    </li>
                                @else
                                    <li class="mb-2">
                                        <a href="{{ route('login') }}" class="hover:underline" wire:navigate>ログイン</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('register') }}" class="hover:underline" wire:navigate>新規登録</a>
                                    </li>
                                @endauth
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-400 uppercase mb-2">法的情報</h3>
                            <ul class="text-gray-300">
                                <li class="mb-2">
                                    <a href="#" class="hover:underline">プライバシーポリシー</a>
                                </li>
                                <li>
                                    <a href="#" class="hover:underline">利用規約</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <hr class="my-6 border-gray-700">
                <div class="text-center">
                    <span class="text-sm text-gray-400">© 2025 共通テスト「情報１」学習サイト. All Rights Reserved.</span>
                </div>
            </div>
        </footer>
    </div>
    
    @livewireScripts
</body>
</html>