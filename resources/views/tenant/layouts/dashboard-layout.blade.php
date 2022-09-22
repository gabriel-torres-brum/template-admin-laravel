<x-app-layout>
    <div class="flex min-h-screen">
        <x-drawer />
        <div
            class="flex flex-1 overflow-hidden transition md:ml-64 md:translate-x-0 mb-6"
            :class="{ 'translate-x-8': showDrawer }"
        >
            <x-header />

            <div class="relative flex flex-1 flex-col mt-16 mx-2 sm:mx-6 overflow-y-auto">
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
    </div>
</x-app-layout>
