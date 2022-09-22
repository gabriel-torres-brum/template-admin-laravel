@props(['head', 'foot'])

<div
    style="background: url('{{ asset('images/pastor-de-ovelhas.jpg') }}') no-repeat center"
    class="flex flex-1 items-center justify-center min-h-screen px-3"
>
    <div class="flex w-full max-w-md flex-col justify-center">
        <div class="flex min-h-[6rem] flex-col items-center justify-center gap-2">
            <a href="{{ tenantRoute('dashboard') }}">
                <x-app-logo />
            </a>
        </div>
        <div
            class="flex flex-col justify-center rounded-xl border border-gray-200 bg-white/60 p-8 shadow-lg dark:border-gray-700 dark:bg-gray-800/60 backdrop-blur-md">
            <x-divider class="mb-2" />
            {{ $head }}
            <x-divider class="mt-2" />
            <form
                class="mt-4 flex w-full flex-col items-end"
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
