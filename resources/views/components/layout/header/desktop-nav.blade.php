<nav class="hidden md:flex space-x-6 items-center">
    <x-layout.header.nav-item url="/" label="ホーム" :navigate="true" />
    <x-layout.header.nav-item url="/schedule" label="スケジュール" :navigate="true" />
    <x-layout.header.nav-item url="/workbook" label="過去問" :navigate="true" />
    <x-layout.header.nav-item url="/analysis" label="成績分析" :navigate="true" />

    <x-layout.header.auth-button display="desktop" />
</nav>
