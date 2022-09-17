<x-app-layout>
    <div class="h-full">
        <x-drawer />
        <div
            class="flex h-full flex-1 flex-col transition md:ml-80 md:translate-x-0"
            :class="{ 'translate-x-8': showDrawer }"
        >

            <x-header />

            <x-preloader />
            
            <div class="w-full flex-none px-4 sm:px-8">
                {{ Breadcrumbs::render() }}
            </div>

            <div class="relative m-4 flex flex-1 flex-col gap-8 sm:m-8">
                <h2
                    class="w-full flex-none text-3xl font-extrabold tracking-tight">
                    @stack('title')
                </h2>
                {{ $slot }}
            </div>
        </div>
    </div>
</x-app-layout>
