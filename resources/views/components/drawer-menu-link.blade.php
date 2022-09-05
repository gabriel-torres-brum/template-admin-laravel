@props([
    'dropdown'
])

<li @isset($dropdown) x-data="{ dropdown: false }" @endisset>

    @isset($dropdown)
        <button
            class="group flex w-full items-center rounded-lg p-2 text-base font-normal text-gray-900 transition duration-75 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 @if(request()->routeIs($route)) bg-gray-100 dark:bg-gray-700 @endif"
            type="button"
            x-on:click="dropdown = ! dropdown"
        >
            <x-icon
                class="h-6 w-6"
                name="{{ $icon }}"
                solid
            />
            <span class="ml-3 flex-1 whitespace-nowrap text-left">{{ $label }}</span>
            <x-icon
                class="h-6 w-6"
                name="chevron-left"
                x-bind:class="{ '-rotate-90': dropdown }"
                solid
            />
        </button>
        <ul
            class="space-y-2 py-2"
            x-cloak
            x-show="dropdown"
            x-collapse
        >
            {{ $dropdown }}
        </ul>
    @else
        <a
            class="flex items-center rounded-lg p-2 text-base font-normal text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
            href="{{ route($route) }}"
        >
            <x-icon
                class="h-6 w-6"
                name="{{ $icon }}"
            />
            <span class="ml-3">{{ $label }}</span>
        </a>
    @endisset
</li>