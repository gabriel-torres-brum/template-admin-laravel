<div>
    <div x-on:click="toggleDrawer" x-show="showDrawer" x-cloak class="fixed md:hidden z-30 h-full w-full bg-gray-500 dark:bg-black opacity-30"></div>
    <aside
        class="fixed z-40 h-full w-80 flex-none -translate-x-80 md:!translate-x-0 transition overflow-y-auto border-r border-gray-200 bg-white p-4 dark:border-gray-700 dark:bg-gray-800"
        :class="{ '!-translate-x-80': !showDrawer, '!translate-x-0': showDrawer }"
    >
        <a
            class="text-xl font-semibold uppercase text-gray-500 dark:text-gray-400"
            href="{{ route('dashboard') }}"
        >
            Menu
        </a>
    
        <button
            class="absolute top-2.5 right-2.5 inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white md:hidden"
            type="button"
            x-on:click="toggleDrawer()"
        >
            <x-icon
                class="h-5 w-5"
                name="x"
                solid
            />
        </button>
    
        <x-drawer-menu />
    </aside>
</div>
