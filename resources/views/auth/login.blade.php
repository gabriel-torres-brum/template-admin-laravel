@push('title', 'Login')

<x-app-layout>
    <x-auth-layout formActionRoute="{{ route('auth.login.index') }}">
        <x-slot name="head">
            <div class="col-span-12 mb-4 flex flex-col gap-1">
                <h3 class="text-xl font-bold">Login</h3>
                <small class="text-xs">Insira suas credenciais para continuar.</small>
            </div>
        </x-slot>
        <div class="col-span-12">
            <x-input
                icon="at-symbol"
                label="Email"
                id="email"
                name="email"
                type="email"
                value="{{ old('email') }}"
            />
        </div>
        <div class="col-span-12">
            <x-input
                icon="lock-closed"
                label="Senha"
                id="password"
                name="password"
                type="password"
            />
        </div>
        <div class="col-span-12 mt-2 flex items-center justify-end gap-4">
            <a
                class="text-primary-500 text-sm hover:underline"
                href="{{ route('auth.forgot-password.index') }}"
            >
                Esqueceu a senha?
            </a>
            <x-button
                label="Acessar"
                type="submit"
                primary
            />
        </div>
        <x-slot name="foot">
            <div class="flex items-center justify-center gap-4 my-4">
                <a
                    class="text-primary-500 text-sm hover:underline"
                    href="{{ route('auth.registration.index') }}"
                >
                    Ainda não tem cadastro?
                </a>
            </div>
        </x-slot>
    </x-auth-layout>
</x-app-layout>
