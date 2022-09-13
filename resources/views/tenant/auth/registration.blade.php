@push('title', 'Cadastre-se')

<x-app-layout>
    <x-tenant.auth-layout formActionRoute="{{ route('auth.registration.index') }}">
        <x-slot name="head">
            <div class="col-span-12 mb-4 flex flex-col gap-1">
                <h3 class="text-xl font-bold">Cadastre-se</h3>
                <small class="text-xs">Insira suas credenciais para continuar.</small>
            </div>
        </x-slot>
        <div class="col-span-12">
            <x-input
                icon="user"
                label="Nome"
                id="name"
                name="name"
                value="{{ old('name') }}"
            />
        </div>
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
        <div
            class="col-span-12"
        >
            <x-inputs.password
                icon="lock-closed"
                label="Senha"
                id="password"
                name="password"
            />
        </div>
        <div class="col-span-12 mt-2 flex items-center justify-end gap-4">
            <a
                class="text-primary-500 text-sm hover:underline"
                href="{{ route('login.index') }}"
            >
                Já é cadastrado?
            </a>
            <x-button
                label="Enviar"
                type="submit"
                primary
            />
        </div>
    </x-tenant.auth-layout>
</x-app-layout>
