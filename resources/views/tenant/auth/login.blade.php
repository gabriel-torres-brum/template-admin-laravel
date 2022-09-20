@push('title', 'Login')

<x-app-layout>
    <x-tenant.auth-layout formActionRoute="{{ tenantRoute('login.handle') }}">
        <x-slot name="head">
            <div class="text-base text-center">
                {{ tenant()->name ?? strtoupper(tenant()->id) }}
            </div>
            <div class="flex flex-col gap-1 text-center">
                <small class="text-sm opacity-70">Insira suas credenciais para acessar o sistema</small>
            </div>
        </x-slot>
        <div class="col-span-12">
            <x-input
                id="email"
                name="email"
                type="email"
                value="{{ old('email') }}"
                icon="at-symbol"
                label="Email"
            />
        </div>
        <div class="col-span-12">
            <x-input
                id="password"
                name="password"
                type="password"
                icon="lock-closed"
                label="Senha"
            />
        </div>
        <div class="col-span-12 mt-2 flex items-center justify-end gap-4">
            <a
                class="text-primary-500 text-sm hover:underline"
                href="{{ tenantRoute('forgot-password.index') }}"
            >
                Esqueceu a senha?
            </a>
            <x-button
                type="submit"
                label="Acessar"
                primary
            />
        </div>
        {{-- <x-slot name="foot">
            <div class="my-4 flex items-center justify-center gap-4">
                <a
                    class="text-primary-500 text-sm hover:underline"
                    href="{{ tenantRoute('auth.registration.index') }}"
                >
                    Ainda não tem cadastro?
                </a>
            </div>
        </x-slot> --}}
    </x-tenant.auth-layout>
</x-app-layout>
