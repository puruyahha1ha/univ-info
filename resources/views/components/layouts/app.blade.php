<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxAppearance
</head>

<body>
    {{-- ヘッダー --}}
    <flux:header>
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:brand href="#" logo="https://fluxui.dev/img/demo/logo.png" name="Acme Inc." class="max-lg:hidden" />

        <flux:navbar class="-mb-px max-lg:hidden">
            <flux:navbar.item icon="home" href="#" current>Home</flux:navbar.item>
            <flux:navbar.item icon="inbox" badge="12" href="#">Inbox</flux:navbar.item>
            <flux:navbar.item icon="document-text" href="#">Documents</flux:navbar.item>
            <flux:navbar.item icon="calendar" href="#">Calendar</flux:navbar.item>

            <flux:separator vertical variant="subtle" class="my-2" />

            <flux:dropdown class="max-lg:hidden">
                <flux:navbar.item icon-trailing="chevron-down">Favorites</flux:navbar.item>

                <flux:navmenu>
                    <flux:navmenu.item href="#">Marketing site</flux:navmenu.item>
                    <flux:navmenu.item href="#">Android app</flux:navmenu.item>
                    <flux:navmenu.item href="#">Brand guidelines</flux:navmenu.item>
                </flux:navmenu>
            </flux:dropdown>
        </flux:navbar>
    </flux:header>
    {{-- メインコンテンツ --}}
    {{ $slot }}

    {{-- フッター --}}

    @fluxScripts
</body>

</html>
