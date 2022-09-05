@unless($breadcrumbs->isEmpty())
    <nav class="py-4 flex border-b border-gray-300 dark:border-gray-800">
        <li class="inline-flex items-center">
            <ol class="inline-flex items-center gap-2 text-sm sm:text-base font-bold tracking-wide text-gray-700 dark:text-gray-200">
                @foreach ($breadcrumbs as $breadcrumb)
                    @if ($breadcrumb->url && !$loop->last)
                        <li class="inline-flex items-center">
                            <a
                                class="flex items-center gap-2 hover:text-gray-900 dark:hover:text-white"
                                href="{{ $breadcrumb->url }}"
                            >
                                @isset($breadcrumb->icon)
                                    <x-icon
                                        class="h-5 w-5"
                                        :name="$breadcrumb->icon"
                                        solid
                                    />
                                @endif
                                {{ $breadcrumb->title }}
                            </a>
                        </li>
                    @else
                        <li class="inline-flex gap-2 items-center">
                            @isset($breadcrumb->icon)
                                <x-icon
                                    class="h-5 w-5"
                                    :name="$breadcrumb->icon"
                                    solid
                                />
                            @endif
                            {{ $breadcrumb->title }}
                        </li>
                    @endif

                    @unless($loop->last)
                        <li class="flex items-center">
                            <x-icon
                                class="h-5 w-5"
                                name="chevron-right"
                                solid
                            />
                        </li>
                    @endif
                    @endforeach
                </ol>
        </nav>
    @endunless
