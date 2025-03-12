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
