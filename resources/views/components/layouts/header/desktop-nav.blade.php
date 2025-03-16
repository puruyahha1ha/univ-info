<nav class="hidden md:flex space-x-6 items-center">
    <x-layouts.header.nav-item url="/" label="ホーム" :navigate="true" />
    <x-layouts.header.nav-item url="/schedule" label="スケジュール" :navigate="true" />
    <x-layouts.header.nav-item url="/workbook" label="過去問" :navigate="true" />
    <x-layouts.header.nav-item url="/analysis" label="成績分析" :navigate="true" />

    <x-layouts.header.auth-button display="desktop" />
</nav>
