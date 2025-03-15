<!-- PC版フッター -->
<footer class="hidden md:block bg-gradient-to-r from-indigo-900 to-purple-900 text-white py-8">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col md:flex-row justify-between mb-8">
            <div class="mb-6 md:mb-0">
                <h3 class="text-lg font-bold mb-3 flex items-center">
                    <flux:icon.globe-alt />
                    サイトタイトル
                </h3>
                <p class="text-indigo-200 max-w-xs">効率的な学習をサポートし、あなたの夢の実現をお手伝いします。</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-8">
                <div>
                    <h4 class="font-semibold mb-3 text-yellow-300">サービス</h4>
                    <ul class="space-y-2 text-indigo-200">
                        <li><a href="/" class="hover:text-white transition-colors" wire:navigate>ホーム</a></li>
                        <li><a href="/schedule" class="hover:text-white transition-colors" wire:navigate>スケジュール</a></li>
                        <li><a href="/workbook" class="hover:text-white transition-colors" wire:navigate>過去問</a></li>
                        <li><a href="/analysis" class="hover:text-white transition-colors" wire:navigate>成績分析</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-3 text-yellow-300">サポート</h4>
                    <ul class="space-y-2 text-indigo-200">
                        <li><a href="#" class="hover:text-white transition-colors">よくある質問</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">お問い合わせ</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">ヘルプセンター</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-3 text-yellow-300">リソース</h4>
                    <ul class="space-y-2 text-indigo-200">
                        <li><a href="#" class="hover:text-white transition-colors">学習ガイド</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">成功事例</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">ブログ</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="pt-8 border-t border-indigo-800 text-center md:flex md:justify-between md:text-left">
            <p class="text-sm text-indigo-300">&copy; {{ date('Y') }} サイトタイトル. All rights reserved.</p>
            <div class="mt-4 md:mt-0 flex justify-center md:justify-end space-x-4">
                <a href="#" class="text-indigo-300 hover:text-white transition-colors">
                    <span class="sr-only">Twitter</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path
                            d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84">
                        </path>
                    </svg>
                </a>
                <a href="#" class="text-indigo-300 hover:text-white transition-colors">
                    <span class="sr-only">Instagram</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63z"
                            clip-rule="evenodd"></path>
                        <path
                            d="M17.25 12C17.25 10.21 15.79 8.75 14 8.75C12.21 8.75 10.75 10.21 10.75 12C10.75 13.79 12.21 15.25 14 15.25C15.79 15.25 17.25 13.79 17.25 12Z">
                        </path>
                    </svg>
                </a>
                <a href="#" class="text-indigo-300 hover:text-white transition-colors">
                    <span class="sr-only">YouTube</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M19.812 5.418c.861.23 1.538.907 1.768 1.768C21.998 8.746 22 12 22 12s0 3.255-.418 4.814a2.504 2.504 0 0 1-1.768 1.768c-1.56.419-7.814.419-7.814.419s-6.255 0-7.814-.419a2.505 2.505 0 0 1-1.768-1.768C2 15.255 2 12 2 12s0-3.255.417-4.814a2.507 2.507 0 0 1 1.768-1.768C5.744 5 11.998 5 11.998 5s6.255 0 7.814.418ZM15.194 12 10 15V9l5.194 3Z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</footer>

<!-- SP版モバイルフッター -->
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
        <a href="/analysis" class="flex flex-col items-center justify-center py-3">
            <flux:icon.chart-bar class="w-6 h-6 mb-1" />
            <span class="text-xs">成績分析</span>
        </a>
        <a href="#" class="flex flex-col items-center justify-center py-3">
            <flux:icon.user-circle class="w-6 h-6 mb-1" />
            <span class="text-xs">プロフィール</span>
        </a>
    </div>
</footer>
