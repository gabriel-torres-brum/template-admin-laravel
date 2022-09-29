<x-app-layout>
    <x-drawer />
    <div class="min-h-screen flex transition md:ml-64 md:translate-x-0" :class="{ 'translate-x-8': showDrawer }">
        <x-header />

        <div class="pt-16 px-2 sm:px-6 overflow-auto flex-1">
            <div class="w-full">
                {{ Breadcrumbs::render() }}
            </div>
            <section>
                {{-- <h2 class="w-full flex-none text-3xl font-extrabold tracking-tight">
                    @stack('title')
                </h2> --}}
                {{ $slot }}
            </section>
        </div>
    </div>
</x-app-layout>
