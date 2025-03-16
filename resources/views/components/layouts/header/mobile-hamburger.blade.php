<button @click="open = !open" class="md:hidden focus:outline-none rounded-full p-2 hover:bg-indigo-500 transition-colors"
    aria-label="Toggle menu">
    <flux:icon.bars-3 />
</button>

{{-- SP用: メニュー展開時のオーバーレイ --}}
<div class="md:hidden fixed inset-0 bg-black bg-opacity-50 z-40 backdrop-blur-sm" x-show="open" x-transition.opacity
    @click="open = false"></div>
