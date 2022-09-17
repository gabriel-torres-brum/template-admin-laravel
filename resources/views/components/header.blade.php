<header class="w-full">
    <nav
        class="flex h-24 items-center border-b border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800">
        <div
            class="mx-auto flex flex-1 flex-wrap items-center justify-between px-4 py-2.5 md:px-8">
            <div class="flex items-center gap-4">
                <x-button.circle
                    class="h-5 w-5 md:hidden"
                    x-on:click="toggleDrawer()"
                    icon="menu"
                />
                <a
                    class="uppercase"
                    href="{{ route('dashboard') }}"
                >
                    @if (tenant())
                        {{ tenant()->id }}
                    @else
                        Administração
                    @endif
                </a>
            </div>
            <div class="flex flex-1 items-center justify-end">
                <x-user-dropdown />
            </div>
        </div>
    </nav>
</header>
