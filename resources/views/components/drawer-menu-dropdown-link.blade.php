<a
    class="group flex w-full items-center rounded-lg p-2 text-base font-normal text-gray-900 transition duration-75 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 @if(request()->routeIs($route)) bg-gray-100 dark:bg-gray-700 @endif"
    href="{{ route($route) }}"
>
    {{ $label }}
</a>
