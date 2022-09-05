<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    :class="{ 'dark': darkMode }"
    x-data="{ darkMode: $persist(false) }"
>

<head>
    <meta charset="utf-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>@stack('title')</title>

    <!-- Fonts -->
    <link
        href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap"
        rel="stylesheet"
    >

    <script>
        if (localStorage._x_darkMode === 'true' || (!('_x_darkMode' in localStorage) && window.matchMedia(
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

<body x-data="drawer()">
    @auth
        <x-drawer />
        <div
            class="h-full flex flex-1 flex-col transition md:translate-x-0 md:ml-80"
            :class="{ 'translate-x-8': showDrawer }"
        >

            <x-header />

            <div class="w-full flex-none px-4 sm:px-8">{{ Breadcrumbs::render() }}</div>
            
            <div class="flex flex-col flex-1 m-4 sm:m-8 gap-8">
                <h2 class="w-full flex-none text-3xl font-extrabold tracking-tight">
                    @stack('title')
                </h2>
                {{ $slot }}
            </div>

        </div>
    @endauth

    @guest
        {{ $slot }}
    @endguest

    @livewireScripts
    @livewire('notifications')
</body>

</html>
