@props(['title', 'items'])

<div>
    <h4 class="font-semibold mb-3 text-yellow-300">{{ $title }}</h4>
    <ul class="space-y-2 text-indigo-200">
        @foreach ($items as $item)
            <li>
                <a href="{{ $item[1] }}" class="hover:text-white transition-colors"
                    @if ($item[2] ?? false) wire:navigate @endif>
                    {{ $item[0] }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
