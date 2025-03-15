@props(['display' => 'desktop']) {{-- desktop or mobile --}}

@guest
    @if ($display == 'desktop')
        <a href="{{ route('login') }}"
            class="bg-white text-indigo-600 hover:bg-yellow-100 font-semibold rounded-full px-5 py-2 transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5"
            wire:navigate>
            ログイン
        </a>
    @else
        <a href="{{ route('login') }}"
            class="block bg-white text-indigo-600 hover:bg-gray-100 font-semibold rounded-lg px-4 py-3 transition-colors text-center shadow-md"
            wire:navigate>
            ログイン
        </a>
    @endif
@endguest

@auth
    @if ($display == 'desktop')
        <a href="{{ route('dashboard') }}"
            class="bg-yellow-400 text-indigo-800 hover:bg-yellow-300 font-semibold rounded-full px-5 py-2 transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5"
            wire:navigate>
            ダッシュボード
        </a>
    @else
        <a href="{{ route('dashboard') }}"
            class="block bg-yellow-400 text-indigo-800 hover:bg-yellow-300 font-semibold rounded-lg px-4 py-3 transition-colors text-center shadow-md"
            wire:navigate>
            ダッシュボード
        </a>
    @endif
@endauth
