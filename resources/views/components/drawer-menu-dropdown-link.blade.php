<a
    class="group flex w-full items-center rounded-lg p-2 text-base font-normal text-gray-600 transition duration-75 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-800 @if(request()->routeIs($route)) bg-gray-100 dark:bg-gray-800 @endif"
    href="{{ tenant() ? tenantRoute($route) : route($route) }}"
>
    {{ $label }}
</a>
