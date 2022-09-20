@props(['dropdown'])

<li
    class="truncate"
    @isset($dropdown) x-data="{ dropdown_{{ $dropdownId }}: $persist(false) }" @endisset
>

    @isset($dropdown)
        <div class="border-2 border-gray-200 dark:border-gray-700 rounded-lg">
            <button
                class="group @if (request()->routeIs($route)) bg-gray-100 dark:bg-gray-700 @endif flex w-full items-center rounded-t-lg p-2 text-base font-normal transition duration-300 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                type="button"
                x-on:click="dropdown_{{ $dropdownId }} = ! dropdown_{{ $dropdownId }}"
            >
                <x-icon
                    class="h-6 w-6"
                    name="{{ $icon }}"
                    solid
                />
                <span
                    class="ml-3 flex-1 whitespace-nowrap text-left">{{ $label }}</span>
                <x-icon
                    class="h-6 w-6"
                    name="chevron-left"
                    x-bind:class="{ '-rotate-90': dropdown_{{ $dropdownId }} }"
                    solid
                />
            </button>
            <ul
                class="space-y-2 p-2"
                x-cloak
                x-show="dropdown_{{ $dropdownId }}"
                x-collapse
            >
                {{ $dropdown }}
            </ul>
        </div>
    @else
        <a
            class="@if (request()->routeIs($route)) bg-gray-100 dark:bg-gray-700 @endif flex items-center rounded-lg border-2 border-gray-200 p-2 text-base font-normal transition duration-300 hover:bg-gray-100 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700"
            href="{{ tenant() ? tenantRoute($route) : route($route) }}"
        >
            <x-icon
                class="h-6 w-6"
                name="{{ $icon }}"
                solid
            />
            <span class="ml-3">{{ $label }}</span>
        </a>
    @endisset
</li>
