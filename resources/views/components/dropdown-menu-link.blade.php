@props(['label'])

<div>
    <a
        href="@if ($route) {{ tenant() ? tenantRoute($route) : route($route) }} @else '#' @endif"
        {{ $attributes->merge(['class' => (request()->routeIs($routeIs) ? 'bg-gray-100 dark:bg-gray-600' : '') . ' block py-2 px-4 text-sm text-gray-600 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-white']) }}
    >
        {{ $label }}
    </a>
    @if ($separator)
        <x-divider />
    @endif
</div>
