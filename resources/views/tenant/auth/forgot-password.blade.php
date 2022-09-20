@push('title', 'Esqueceu a senha')

<x-app-layout>
    <x-tenant.auth-layout formActionRoute="{{ tenantRoute('forgot-password.handle') }}">
        <x-slot name="head">
            <div class="col-span-12 mb-4 flex flex-col gap-1">
                <h3 class="text-xl font-bold">Esqueceu a senha?</h3>
                <small class="text-xs">Informe seu e-mail. Enviaremos um link para redefinição de senha</small>
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
        <div class="col-span-12 mt-2 flex items-center justify-end gap-4">
            <a
                class="text-primary-500 text-sm hover:underline"
                href="{{ tenantRoute('login.index') }}"
            >
                Voltar para o login
            </a>
            <x-button
                type="submit"
                label="Enviar"
                primary
            />
        </div>
    </x-tenant.auth-layout>
</x-app-layout>
