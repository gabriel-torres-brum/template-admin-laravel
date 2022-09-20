@push('title', 'Login')

<x-app-layout>
    <x-tenant.auth-layout formActionRoute="{{ tenantRoute('login.handle') }}">
        <x-slot name="head">
            <div class="text-2xl border-b-2 border-gray-200 dark:border-gray-700 pb-2 mb-4">
                {{ tenant()->id }}
            </div>
            <div class="mb-4 flex flex-col gap-1 text-center">
                <h3 class="text-xl font-bold">Login</h3>
                <small class="text-base opacity-60">Insira suas credenciais de acesso</small>
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
        <x-slot name="foot">
            <div class="my-4 flex items-center justify-center gap-4">
                <a
                    class="text-primary-500 text-sm hover:underline"
                    href="{{ tenantRoute('auth.registration.index') }}"
                >
                    Ainda não tem cadastro?
                </a>
            </div>
        </x-slot>
    </x-tenant.auth-layout>
</x-app-layout>
