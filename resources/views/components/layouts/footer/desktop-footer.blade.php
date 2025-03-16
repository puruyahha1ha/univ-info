@props(['siteTitle'])

<footer class="hidden md:block bg-gradient-to-r from-indigo-900 to-purple-900 text-white py-8">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col md:flex-row justify-between mb-8">
            <div class="mb-6 md:mb-0">
                <h3 class="text-lg font-bold mb-3 flex items-center">
                    <flux:icon.globe-alt />
                    {{ $siteTitle }}
                </h3>
                <p class="text-indigo-200 max-w-xs">効率的な学習をサポートし、あなたの夢の実現をお手伝いします。</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-8">
                <x-layouts.footer.footer-menu title="サービス" :items="[
                    ['ホーム', '/', true],
                    ['スケジュール', '/schedule', true],
                    ['過去問', '/workbook', true],
                    ['成績分析', '/analysis', true],
                ]" />

                <x-layouts.footer.footer-menu title="サポート" :items="[['よくある質問', '#', false], ['お問い合わせ', '#', false], ['ヘルプセンター', '#', false]]" />

                <x-layouts.footer.footer-menu title="リソース" :items="[['学習ガイド', '#', false], ['成功事例', '#', false], ['ブログ', '#', false]]" />
            </div>
        </div>
        <div class="pt-8 border-t border-indigo-800 text-center md:flex md:justify-between md:text-left items-center">
            <p class="text-sm text-indigo-300">&copy; {{ date('Y') }} {{ $siteTitle }}. All rights reserved.</p>
            <x-layouts.footer.social-icons />
        </div>
    </div>
</footer>
