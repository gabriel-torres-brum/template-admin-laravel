<div
    x-cloak
    id="drawer"
    class="fixed z-40 h-screen w-80 overflow-y-auto bg-white p-4 dark:bg-gray-800"
    tabindex="-1"
>

    <a
        href="{{ route('dashboard') }}"
        id="drawer-title"
        class="text-base font-semibold uppercase text-gray-500 dark:text-gray-400"
    >
        Menu
    </a>

    <button
        type="button"
        data-drawer-dismiss="drawer"
        class="absolute top-2.5 right-2.5 inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
    >
        <x-icon
            name="x"
            class="h-5 w-5"
        />
    </button>

    <div class="overflow-y-auto py-4">
        <ul class="space-y-2">
            <li>
                <a
                    href="#"
                    class="flex items-center rounded-lg p-2 text-base font-normal text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                >
                    <x-icon
                        name="chart-pie"
                        class="h-6 w-6"
                    />
                    <span class="ml-3">Início</span>
                </a>
            </li>
            <li>
                <button
                    type="button"
                    class="group flex w-full items-center rounded-lg p-2 text-base font-normal text-gray-900 transition duration-75 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                    data-collapse-toggle="dropdown-drawer-1"
                >
                    <x-icon
                        name="chart-pie"
                        class="h-6 w-6"
                    />
                    <span class="ml-3 flex-1 whitespace-nowrap text-left">Dropdown</span>
                    <x-icon
                        name="chevron-down"
                        class="h-6 w-6"
                    />
                </button>
                <ul
                    id="dropdown-drawer-1"
                    class="hidden space-y-2 py-2"
                >
                    <li>
                        <a
                            href="#"
                            class="group flex w-full items-center rounded-lg p-2 pl-11 text-base font-normal text-gray-900 transition duration-75 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                        >
                            Dropdown item
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
