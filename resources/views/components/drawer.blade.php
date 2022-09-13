<div>
    <div
        class="fixed z-30 h-full w-full bg-gray-500 opacity-30 dark:bg-black md:hidden"
        x-on:click="toggleDrawer"
        x-show="showDrawer"
        x-cloak
    ></div>
    <aside
        class="fixed z-40 h-full w-80 flex-none -translate-x-80 overflow-y-auto border-r border-gray-200 bg-white px-4 shadow-md transition dark:border-gray-700 dark:bg-gray-800 md:!translate-x-0"
        :class="{ '!-translate-x-80': !showDrawer, '!translate-x-0': showDrawer }"
    >

        <div class="relative flex h-24 items-center">
            <x-app-logo class="text-2xl" />
            <x-button.circle
                class="absolute top-4 right-0 md:hidden"
                sm
                x-on:click="toggleDrawer()"
                icon="x"
                outline
            />
        </div>

        @if (tenant())
            <x-tenant.drawer-menu />
        @else
            <x-system.drawer-menu />
        @endif
    </aside>
</div>
