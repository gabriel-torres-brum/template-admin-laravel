<div>
    <div
        class="fixed z-20 h-full w-full bg-gray-500 opacity-60 dark:bg-gray-800 md:hidden"
        x-on:click="toggleDrawer"
        x-show="showDrawer"
        x-cloak
    ></div>
    <aside
        class="fixed z-40 h-full w-64 flex-none -translate-x-64 overflow-y-auto border-r border-gray-200 bg-white px-4 shadow-md transition dark:border-gray-700 dark:bg-gray-800 md:!translate-x-0"
        :class="{ '!-translate-x-64': !showDrawer, '!translate-x-0': showDrawer }"
    >

        <div class="relative flex h-16 items-center">
            <x-app-logo class="text-2xl" />
            {{-- <x-button.circle
                class="absolute top-4 right-0 md:hidden"
                sm
                x-on:click="toggleDrawer()"
                icon="x"
                outline
            /> --}}
        </div>

        @if (tenant())
            <x-tenant.drawer-menu />
        @else
            <x-system.drawer-menu />
        @endif
    </aside>
</div>
