@props([
    'url' => '#',
    'label' => '',
    'icon' => null,
    'mobile' => false,
    'navigate' => false,
])

@if ($mobile)
    <a href="{{ $url }}"
        class="hover:bg-indigo-500 px-4 py-3 rounded-lg transition-colors flex items-center space-x-3"
        @if ($navigate) wire:navigate @endif>
        @if ($icon)
            <flux:icon.{{ $icon }} />
        @endif
        <span>{{ $label }}</span>
    </a>
@else
    <a href="{{ $url }}" class="hover:text-yellow-300 transition-colors font-medium"
        @if ($navigate) wire:navigate @endif>
        {{ $label }}
    </a>
@endif
