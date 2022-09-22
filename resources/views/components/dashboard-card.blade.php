@props(['header', 'footer'])

<a
    href="{{ tenant() ? tenantRoute($route) : route($route) }}"
    {{ $attributes->merge(['class' => 'hover:scale-[99%] opacity-90 hover:opacity-100 transition-gpu duration-300 rounded-lg p-2 md:p-4 shadow text-gray-600 dark:text-gray-100']) }}
>
    {{ $header }}

    <div class="mb-6"></div>

    {{ $footer }}
</a>
