<footer class="fixed bottom-0 left-0 w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white md:hidden z-30">
    <div class="max-w-7xl mx-auto grid grid-cols-5 w-full">
        <a href="/" class="flex flex-col items-center justify-center py-3" wire:navigate>
            <flux:icon.home class="w-6 h-6 mb-1" />
            <span class="text-xs">ホーム</span>
        </a>
        <a href="/workbook" class="flex flex-col items-center justify-center py-3" wire:navigate>
            <flux:icon.book-open class="w-6 h-6 mb-1" />
            <span class="text-xs">過去問</span>
        </a>
        <a href="/schedule" class="flex flex-col items-center justify-center py-3" wire:navigate>
            <flux:icon.calendar class="w-6 h-6 mb-1" />
            <span class="text-xs">スケジュール</span>
        </a>
        <a href="/analysis" class="flex flex-col items-center justify-center py-3" wire:navigate>
            <flux:icon.chart-bar class="w-6 h-6 mb-1" />
            <span class="text-xs">成績分析</span>
        </a>
        <a href="#" class="flex flex-col items-center justify-center py-3">
            <flux:icon.user-circle class="w-6 h-6 mb-1" />
            <span class="text-xs">プロフィール</span>
        </a>
    </div>
</footer>
