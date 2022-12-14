@props(['head', 'foot'])

<div class="grid min-h-screen place-items-center p-6">
    <div class="flex w-full max-w-xl flex-col justify-center">
        <div class="flex flex-col items-center justify-center gap-2">
            <a href="{{ route('admin.dashboard') }}">
               <x-app-logo />
            </a>
        </div>
        <div class="my-2"></div>
        <div
            class="flex flex-col justify-center rounded-md border border-gray-200 bg-white p-8 shadow-lg dark:border-gray-700 dark:bg-gray-800">
            
            <x-errors
                title="Não foi possível continuar"
                only="error"
                class="my-2"
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
