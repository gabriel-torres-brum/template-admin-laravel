@props(['head', 'foot'])

<div class="flex h-full items-stretch">
    <div class="flex justify-center items-center flex-1">
        <div class="flex w-full max-w-md flex-col justify-center">
            <div class="flex flex-col items-center justify-center gap-2">
                <a href="{{ route('dashboard') }}">
                    <x-app-logo />
                </a>
            </div>
            <div class="my-2"></div>
            <div
                class="flex flex-col justify-center rounded-md border border-gray-200 bg-white p-8 shadow-lg dark:border-gray-700 dark:bg-gray-800">

                <x-errors
                    class="my-2"
                    title="Não foi possível continuar"
                    only="error"
                />

                {{ $head }}

                <form
                    class="flex w-full flex-col items-end"
                    action="{{ $formActionRoute }}"
                    method="POST"
                >
                    @csrf
                    <div class="grid w-full grid-cols-12 gap-4">
                        {{ $slot }}
                    </div>
                </form>

            </div>

            {{ $foot }}

        </div>
    </div>
    <div
        class="hidden lg:flex from-primary-200 to-primary-400 dark:from-primary-800 dark:to-primary-900 max-w-[50%] flex-1 items-center border-r-2 border-gray-200 bg-gradient-to-r dark:border-gray-700">
        <h5 class="text-xl font-extrabold tracking-tight"></h5>
    </div>
</div>
