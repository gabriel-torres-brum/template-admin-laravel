@unless($breadcrumbs->isEmpty())
    <nav
        class="flex overflow-x-auto whitespace-nowrap py-4">
        <ol
            class="inline-flex items-center gap-2 text-sm font-bold tracking-wide text-gray-600 dark:text-gray-200 sm:text-base">
            @foreach ($breadcrumbs as $breadcrumb)
                @if ($breadcrumb->url && !$loop->last)
                    <li class="inline-flex items-center">
                        <a
                            class="flex items-center gap-2 hover:text-gray-600 dark:hover:text-white"
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
                    <li class="inline-flex items-center gap-2">
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
