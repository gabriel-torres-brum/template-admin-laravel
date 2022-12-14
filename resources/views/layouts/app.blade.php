<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" :class="{ 'dark': darkMode }" x-data="{ darkMode: $persist(false) }">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@stack('title')</title>

    <script>
        if (localStorage._x_darkMode === 'true' || (!('_x_darkMode' in
                localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add("dark")
        } else {
            document.documentElement.classList.remove("dark")
        }
    </script>

    @wireUiScripts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @stack('scripts')
</head>

<body x-data="drawer()" :class="{ 'overflow-hidden': showDrawer }">
    <x-preloader />

    {{ $slot }}

    @livewire('notifications')
    @livewireScripts
    <script>
        window.livewire_app_url = "{{ tenant() ? '/' . tenant()->getTenantKey() : '' }}";
    </script>
</body>

</html>
