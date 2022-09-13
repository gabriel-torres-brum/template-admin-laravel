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
                <div
                    class="relative flex items-center gap-3 md:order-2"
                    x-data="{ userDropdown: false }"
                >

                    <span class="hidden text-base font-bold sm:inline-block">
                        {{ auth()->user()->name }}
                    </span>

                    <x-button.circle
                        icon="user"
                        x-on:click="userDropdown = !userDropdown"
                        x-on:click.away="userDropdown = false"
                    />

                    <!-- Dropdown menu -->
                    <div
                        class="absolute top-10 right-0 z-20 my-4 list-none divide-y divide-gray-100 rounded bg-white text-base shadow after:absolute after:-top-2 after:right-2 after:h-4 after:w-4 after:rotate-45 after:border-l after:border-t after:border-gray-100 after:bg-white dark:divide-gray-600 dark:bg-gray-700 dark:after:border-gray-700 dark:after:bg-gray-700"
                        x-cloak
                        x-show="userDropdown"
                    >
                        <div class="py-3 px-4">
                            <span
                                class="block text-sm text-gray-900 dark:text-white"
                            >
                                {{ auth()->user()->name }}
                            </span>
                            <span
                                class="block truncate text-sm font-medium text-gray-500 dark:text-gray-400"
                            >{{ auth()->user()->email }}
                            </span>
                        </div>
                        <ul class="py-1">
                            <li>
                                <x-dropdown-menu-link
                                    x-on:click.prevent="darkMode = !darkMode"
                                    separator
                                >
                                    <x-slot name="label">
                                        <div
                                            class="flex items-center gap-2"
                                            x-cloak
                                            x-show="darkMode"
                                        >
                                            <x-icon
                                                class="h-5 w-5"
                                                name="sun"
                                            />
                                            <span>Modo claro</span>
                                        </div>
                                        <div
                                            class="flex items-center gap-2"
                                            x-cloak
                                            x-show="!darkMode"
                                        >
                                            <x-icon
                                                class="h-5 w-5"
                                                name="moon"
                                            />
                                            <span>Modo escuro</span>
                                        </div>
                                    </x-slot>
                                </x-dropdown-menu-link>
                            </li>
                            <li>
                                <x-dropdown-menu-link :route="tenant() ? 'logout' : 'admin.logout'">
                                    <x-slot name="label">
                                        <div class="flex items-center gap-2">
                                            <x-icon
                                                class="h-5 w-5"
                                                name="logout"
                                            />
                                            <span>Sair</span>
                                        </div>
                                    </x-slot>
                                </x-dropdown-menu-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
