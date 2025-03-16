<div>
    <livewire:home.hero-section />

    <livewire:home.features-section />
    <!-- サイトの特徴 -->
    {{-- <section class="py-16 px-4 bg-white">
        <div class="max-w-7xl mx-auto text-center mb-12">
            <span
                class="inline-block px-3 py-1 rounded-full bg-indigo-100 text-indigo-600 font-medium text-sm mb-3">サポート機能</span>
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800">合格に近づく<span class="text-indigo-600">3つの特徴</span>
            </h2>
            <p class="text-gray-600 mt-3 max-w-2xl mx-auto">効率的に合格を目指すための充実した機能を提供します</p>
        </div>
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- 特徴1 -->
            <div
                class="bg-white rounded-xl shadow-lg p-6 transition-all duration-300 hover:shadow-xl transform hover:-translate-y-2">
                <div class="mb-6 flex justify-center">
                    <div class="w-16 h-16 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2C7.03 2 3 6.03 3 11c0 4.97 4.03 9 9 9s9-4.03 9-9c0-4.97-4.03-9-9-9zm3 13H9v-2h6v2zm2-4H7V9h10v2z" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-xl font-bold mb-3 text-gray-800">豊富な入試情報</h3>
                <p class="text-gray-600">
                    最新の入試情報を随時更新。大学の詳細情報や受験科目などを簡単に確認できます。学習計画の立案に役立ちます。
                </p>
            </div>
            <!-- 特徴2 -->
            <div
                class="bg-white rounded-xl shadow-lg p-6 transition-all duration-300 hover:shadow-xl transform hover:-translate-y-2">
                <div class="mb-6 flex justify-center">
                    <div class="w-16 h-16 rounded-full bg-purple-100 flex items-center justify-center text-purple-600">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M5 4h14v2H5zm2 4h10v2H7zm-2 4h14v2H5zm2 4h10v2H7z" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-xl font-bold mb-3 text-gray-800">個別学習プラン</h3>
                <p class="text-gray-600">
                    一人ひとりの目標や弱点に合わせた学習プランを自動提案。効率的に勉強を進められます。
                </p>
            </div>
            <!-- 特徴3 -->
            <div
                class="bg-white rounded-xl shadow-lg p-6 transition-all duration-300 hover:shadow-xl transform hover:-translate-y-2">
                <div class="mb-6 flex justify-center">
                    <div class="w-16 h-16 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M3 6l9 6 9-6v12H3z" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-xl font-bold mb-3 text-gray-800">カスタムテスト機能</h3>
                <p class="text-gray-600">
                    過去問や模試を自由に組み合わせ、あなた専用の模擬試験を作成。弱点克服に役立ちます。
                </p>
            </div>
        </div>
    </section> --}}

    <!-- クイックアクセス -->
    <section class="bg-gray-50 py-16 px-4">
        <div class="max-w-7xl mx-auto text-center mb-12">
            <span
                class="inline-block px-3 py-1 rounded-full bg-purple-100 text-purple-600 font-medium text-sm mb-3">クイックナビ</span>
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800">すぐに使いたい機能へ</h2>
            <p class="text-gray-600 mt-3 max-w-2xl mx-auto">学習に役立つ機能へ簡単にアクセスできます</p>
        </div>
        <div class="max-w-6xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-6">
            <!-- アクセス1 -->
            <a href="/exam-info"
                class="block bg-white p-6 rounded-xl shadow hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 group">
                <div
                    class="bg-indigo-100 text-indigo-600 w-14 h-14 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300">
                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14l4-4h12c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z" />
                    </svg>
                </div>
                <h3
                    class="text-lg font-semibold text-center text-gray-800 group-hover:text-indigo-600 transition-colors duration-300">
                    入試情報</h3>
            </a>
            <!-- アクセス2 -->
            <a href="/study-plan"
                class="block bg-white p-6 rounded-xl shadow hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 group">
                <div
                    class="bg-purple-100 text-purple-600 w-14 h-14 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:bg-purple-600 group-hover:text-white transition-colors duration-300">
                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M5 4h14v2H5zm2 4h10v2H7zm-2 4h14v2H5zm2 4h10v2H7z" />
                    </svg>
                </div>
                <h3
                    class="text-lg font-semibold text-center text-gray-800 group-hover:text-purple-600 transition-colors duration-300">
                    学習プラン</h3>
            </a>
            <!-- アクセス3 -->
            <a href="/workbook"
                class="block bg-white p-6 rounded-xl shadow hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 group">
                <div
                    class="bg-blue-100 text-blue-600 w-14 h-14 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 2H5c-1.1 0-2 .9-2 2v16l7-3 7 3V4c0-1.1-.9-2-2-2z" />
                    </svg>
                </div>
                <h3
                    class="text-lg font-semibold text-center text-gray-800 group-hover:text-blue-600 transition-colors duration-300">
                    過去問</h3>
            </a>
            <!-- アクセス4 -->
            <a href="#testimonials"
                class="block bg-white p-6 rounded-xl shadow hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 group">
                <div
                    class="bg-yellow-100 text-yellow-600 w-14 h-14 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:bg-yellow-600 group-hover:text-white transition-colors duration-300">
                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 12c2.7 0 5.2-1.3 6.8-3.4L12 2 5.2 8.6C6.8 10.7 9.3 12 12 12zm0 2c-3.5 0-10 1.8-10 5.3V22h20v-2.7c0-3.5-6.5-5.3-10-5.3z" />
                    </svg>
                </div>
                <h3
                    class="text-lg font-semibold text-center text-gray-800 group-hover:text-yellow-600 transition-colors duration-300">
                    合格者の声</h3>
            </a>
        </div>
    </section>

    <!-- 合格者の声 (Testimonials) -->
    <section id="testimonials" class="py-16 px-4 bg-white">
        <div class="max-w-7xl mx-auto text-center mb-12">
            <span
                class="inline-block px-3 py-1 rounded-full bg-yellow-100 text-yellow-600 font-medium text-sm mb-3">体験談</span>
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800">先輩たちの<span class="text-yellow-500">成功体験</span>
            </h2>
            <p class="text-gray-600 mt-3 max-w-2xl mx-auto">実際に合格を勝ち取った先輩たちの声をご紹介</p>
        </div>

        <!-- モダンなカルーセル -->
        <div class="max-w-6xl mx-auto relative" x-data="{ currentIndex: 0 }">
            <div class="overflow-hidden rounded-xl">
                <!-- スライド全体を横並びに -->
                <div class="flex transition-transform duration-500 ease-in-out"
                    :style="'transform: translateX(-' + currentIndex * 100 + '%)'">
                    <!-- スライド1 -->
                    <div class="min-w-full px-4">
                        <div class="bg-gradient-to-br from-indigo-50 to-white rounded-xl shadow-lg p-8 relative">
                            <div class="absolute top-4 right-4 text-indigo-300">
                                <svg class="w-10 h-10 opacity-50" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M6.5 10c-.223 0-.437.034-.65.065.069-.232.14-.468.254-.68.114-.308.292-.575.469-.844.148-.291.409-.488.601-.737.201-.242.475-.403.692-.604.213-.21.492-.315.714-.463.232-.133.434-.28.65-.35.208-.086.39-.16.539-.222.302-.125.474-.197.474-.197L9.758 4.03c0 0-.218.052-.597.144C8.97 4.222 8.737 4.278 8.472 4.345c-.271.05-.56.187-.882.312C7.272 4.799 6.904 4.895 6.562 5.123c-.344.218-.741.4-1.091.692C5.132 6.116 4.723 6.377 4.421 6.76c-.33.358-.656.734-.909 1.162C3.219 8.33 3.02 8.778 2.81 9.221c-.19.443-.343.896-.468 1.336-.237.882-.343 1.72-.384 2.437-.034.718-.014 1.315.028 1.747.015.204.043.402.063.539.017.109.025.168.025.168l.026-.006C2.535 17.474 4.338 19 6.5 19c2.485 0 4.5-2.015 4.5-4.5S8.985 10 6.5 10zM17.5 10c-.223 0-.437.034-.65.065.069-.232.14-.468.254-.68.114-.308.292-.575.469-.844.148-.291.409-.488.601-.737.201-.242.475-.403.692-.604.213-.21.492-.315.714-.463.232-.133.434-.28.65-.35.208-.086.39-.16.539-.222.302-.125.474-.197.474-.197L20.758 4.03c0 0-.218.052-.597.144-.191.048-.424.104-.689.171-.271.05-.56.187-.882.312-.317.143-.686.238-1.028.467-.344.218-.741.4-1.091.692-.339.301-.748.562-1.05.944-.33.358-.656.734-.909 1.162C14.219 8.33 14.02 8.778 13.81 9.221c-.19.443-.343.896-.468 1.336-.237.882-.343 1.72-.384 2.437-.034.718-.014 1.315.028 1.747.015.204.043.402.063.539.017.109.025.168.025.168l.026-.006C13.535 17.474 15.338 19 17.5 19c2.485 0 4.5-2.015 4.5-4.5S19.985 10 17.5 10z" />
                                </svg>
                            </div>
                            <p class="text-gray-600 mb-6 text-lg italic">
                                「効率的な学習プランのおかげで苦手科目を克服し、第一志望に合格できました！先生からのフィードバックが的確で、短期間で実力がつきました。」
                            </p>
                            <div class="flex items-center">
                                <div
                                    class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-500 font-bold mr-4">
                                    A</div>
                                <div>
                                    <div class="font-bold text-gray-800">Aさん</div>
                                    <div class="text-gray-500 text-sm">文系 / 国立大学合格</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- スライド2 -->
                    <div class="min-w-full px-4">
                        <div class="bg-gradient-to-br from-purple-50 to-white rounded-xl shadow-lg p-8 relative">
                            <div class="absolute top-4 right-4 text-purple-300">
                                <svg class="w-10 h-10 opacity-50" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M6.5 10c-.223 0-.437.034-.65.065.069-.232.14-.468.254-.68.114-.308.292-.575.469-.844.148-.291.409-.488.601-.737.201-.242.475-.403.692-.604.213-.21.492-.315.714-.463.232-.133.434-.28.65-.35.208-.086.39-.16.539-.222.302-.125.474-.197.474-.197L9.758 4.03c0 0-.218.052-.597.144C8.97 4.222 8.737 4.278 8.472 4.345c-.271.05-.56.187-.882.312C7.272 4.799 6.904 4.895 6.562 5.123c-.344.218-.741.4-1.091.692C5.132 6.116 4.723 6.377 4.421 6.76c-.33.358-.656.734-.909 1.162C3.219 8.33 3.02 8.778 2.81 9.221c-.19.443-.343.896-.468 1.336-.237.882-.343 1.72-.384 2.437-.034.718-.014 1.315.028 1.747.015.204.043.402.063.539.017.109.025.168.025.168l.026-.006C2.535 17.474 4.338 19 6.5 19c2.485 0 4.5-2.015 4.5-4.5S8.985 10 6.5 10zM17.5 10c-.223 0-.437.034-.65.065.069-.232.14-.468.254-.68.114-.308.292-.575.469-.844.148-.291.409-.488.601-.737.201-.242.475-.403.692-.604.213-.21.492-.315.714-.463.232-.133.434-.28.65-.35.208-.086.39-.16.539-.222.302-.125.474-.197.474-.197L20.758 4.03c0 0-.218.052-.597.144-.191.048-.424.104-.689.171-.271.05-.56.187-.882.312-.317.143-.686.238-1.028.467-.344.218-.741.4-1.091.692-.339.301-.748.562-1.05.944-.33.358-.656.734-.909 1.162C14.219 8.33 14.02 8.778 13.81 9.221c-.19.443-.343.896-.468 1.336-.237.882-.343 1.72-.384 2.437-.034.718-.014 1.315.028 1.747.015.204.043.402.063.539.017.109.025.168.025.168l.026-.006C13.535 17.474 15.338 19 17.5 19c2.485 0 4.5-2.015 4.5-4.5S19.985 10 17.5 10z" />
                                </svg>
                            </div>
                            <p class="text-gray-600 mb-6 text-lg italic">
                                「過去問の分析ツールがとても役立ちました。合格に必要なポイントが明確になり、効率よく学習を進められました。特に弱点分析機能は素晴らしいです。」
                            </p>
                            <div class="flex items-center">
                                <div
                                    class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center text-purple-500 font-bold mr-4">
                                    B</div>
                                <div>
                                    <div class="font-bold text-gray-800">Bさん</div>
                                    <div class="text-gray-500 text-sm">理系 / 私立大学医学部合格</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- スライド3 -->
                    <div class="min-w-full px-4">
                        <div class="bg-gradient-to-br from-yellow-50 to-white rounded-xl shadow-lg p-8 relative">
                            <div class="absolute top-4 right-4 text-yellow-300">
                                <svg class="w-10 h-10 opacity-50" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M6.5 10c-.223 0-.437.034-.65.065.069-.232.14-.468.254-.68.114-.308.292-.575.469-.844.148-.291.409-.488.601-.737.201-.242.475-.403.692-.604.213-.21.492-.315.714-.463.232-.133.434-.28.65-.35.208-.086.39-.16.539-.222.302-.125.474-.197.474-.197L9.758 4.03c0 0-.218.052-.597.144C8.97 4.222 8.737 4.278 8.472 4.345c-.271.05-.56.187-.882.312C7.272 4.799 6.904 4.895 6.562 5.123c-.344.218-.741.4-1.091.692C5.132 6.116 4.723 6.377 4.421 6.76c-.33.358-.656.734-.909 1.162C3.219 8.33 3.02 8.778 2.81 9.221c-.19.443-.343.896-.468 1.336-.237.882-.343 1.72-.384 2.437-.034.718-.014 1.315.028 1.747.015.204.043.402.063.539.017.109.025.168.025.168l.026-.006C2.535 17.474 4.338 19 6.5 19c2.485 0 4.5-2.015 4.5-4.5S8.985 10 6.5 10zM17.5 10c-.223 0-.437.034-.65.065.069-.232.14-.468.254-.68.114-.308.292-.575.469-.844.148-.291.409-.488.601-.737.201-.242.475-.403.692-.604.213-.21.492-.315.714-.463.232-.133.434-.28.65-.35.208-.086.39-.16.539-.222.302-.125.474-.197.474-.197L20.758 4.03c0 0-.218.052-.597.144-.191.048-.424.104-.689.171-.271.05-.56.187-.882.312-.317.143-.686.238-1.028.467-.344.218-.741.4-1.091.692-.339.301-.748.562-1.05.944-.33.358-.656.734-.909 1.162C14.219 8.33 14.02 8.778 13.81 9.221c-.19.443-.343.896-.468 1.336-.237.882-.343 1.72-.384 2.437-.034.718-.014 1.315.028 1.747.015.204.043.402.063.539.017.109.025.168.025.168l.026-.006C13.535 17.474 15.338 19 17.5 19c2.485 0 4.5-2.015 4.5-4.5S19.985 10 17.5 10z" />
                                </svg>
                            </div>
                            <p class="text-gray-600 mb-6 text-lg italic">
                                「模擬試験を自分でカスタマイズできるので、弱点を重点的に強化できました！スケジュール管理機能と組み合わせることで、無駄なく学習できました。」
                            </p>
                            <div class="flex items-center">
                                <div
                                    class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center text-yellow-500 font-bold mr-4">
                                    C</div>
                                <div>
                                    <div class="font-bold text-gray-800">Cさん</div>
                                    <div class="text-gray-500 text-sm">文系 / 国公立大学合格</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ナビゲーションボタン -->
            <div class="flex justify-center mt-8 space-x-4">
                <button
                    class="bg-indigo-600 text-white p-3 rounded-full hover:bg-indigo-700 transition-colors shadow-md focus:outline-none"
                    @click="currentIndex = (currentIndex - 1 + 3) % 3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                        </path>
                    </svg>
                </button>
                <button
                    class="bg-indigo-600 text-white p-3 rounded-full hover:bg-indigo-700 transition-colors shadow-md focus:outline-none"
                    @click="currentIndex = (currentIndex + 1) % 3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                        </path>
                    </svg>
                </button>
            </div>
        </div>
    </section>

    <!-- 最終CTA -->
    <section class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-16 px-4 relative overflow-hidden">
        <!-- 背景の装飾要素 -->
        <div class="absolute inset-0 overflow-hidden opacity-10">
            <div class="absolute -left-10 top-10 w-40 h-40 bg-yellow-300 rounded-full"></div>
            <div class="absolute right-10 -bottom-10 w-64 h-64 bg-indigo-300 rounded-full"></div>
        </div>

        <div class="max-w-7xl mx-auto text-center relative z-10">
            <h2 class="text-2xl md:text-4xl font-bold mb-6">あなたの合格を<span class="text-yellow-300">全力でサポート</span>します
            </h2>
            <p class="mb-8 text-indigo-100 max-w-2xl mx-auto text-lg">
                学習プランの作成から合格まで、頼れるサポート体制を整えています。今すぐ学習を始めましょう！
            </p>
            <a href="{{ route('register') }}"
                class="inline-block bg-yellow-400 text-indigo-900 font-semibold px-8 py-4 rounded-full shadow-lg hover:bg-yellow-300 transition-all transform hover:-translate-y-1 hover:shadow-xl">
                無料会員登録はこちら
            </a>
            <p class="mt-4 text-indigo-200 text-sm">登録は1分で完了します。クレジットカードは不要です。</p>
        </div>
    </section>
</div>
