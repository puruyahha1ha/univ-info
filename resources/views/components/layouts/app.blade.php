<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body class="min-h-screen font-sans">
    {{-- ヘッダー --}}
    <x-layouts.header.header :site-title="config('app.name', 'Laravel')" />

    {{-- メインコンテンツ --}}
    <main class="my-16 md:mt-0">
        {{ $slot }}
    </main>

    <!-- フッター -->
    <x-layouts.footer.footer :siteTitle="config('app.name')" />

    @stack('scripts')
</body>

</html>
