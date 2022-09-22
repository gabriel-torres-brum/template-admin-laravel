<header
    class="fixed inset-x-0 top-0 z-30 flex h-16 items-center border-b border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800"
>
    <div class="mx-auto flex flex-1 flex-wrap items-center justify-between px-2 sm:px-6">
        <div class="flex items-center gap-4">
            <x-button.circle
                class="md:hidden"
                x-on:click="toggleDrawer()"
                white
                sm
            >
                <x-icon
                    class="h-4 w-4"
                    name="bars-4"
                    solid
                />
            </x-button.circle>
            <a
                class="uppercase"
                href="{{ tenant() ? tenantRoute('dashboard') : route('dashboard') }}"
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
</header>
