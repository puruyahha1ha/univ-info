<section class="py-16 px-4 bg-white">
    <div class="max-w-7xl mx-auto text-center mb-12">
        <span
            class="inline-block px-3 py-1 rounded-full bg-indigo-100 text-indigo-600 font-medium text-sm mb-3">サポート機能</span>
        <h2 class="text-2xl md:text-3xl font-bold text-gray-800">合格に近づく<span class="text-indigo-600">3つの特徴</span>
        </h2>
        <p class="text-gray-600 mt-3 max-w-2xl mx-auto">効率的に合格を目指すための充実した機能を提供します</p>
    </div>

    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach($features as $feature)
            <div
                class="bg-white rounded-xl shadow-lg p-6 transition-all duration-300 hover:shadow-xl transform hover:-translate-y-2">
                <div class="mb-6 flex justify-center">
                    <div class="w-16 h-16 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600">
                        <flux:icon.{{ $feature['icon'] }} class="w-8 h-8" />
                    </div>
                <h3 class="text-xl font-bold mb-3 text-gray-800">豊富な入試情報</h3>
                <p class="text-gray-600">
                    最新の入試情報を随時更新。大学の詳細情報や受験科目などを簡単に確認できます。学習計画の立案に役立ちます。
                </p>
            </div>
        @endforeach
    </div>
</section>