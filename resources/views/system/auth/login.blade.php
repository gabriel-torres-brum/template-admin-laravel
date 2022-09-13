@push('title', 'Administração')

<x-app-layout>
    <x-system.auth-layout formActionRoute="{{ route('admin.login.handle') }}">
        <x-slot name="head">
            <div class="col-span-12 mb-4 flex flex-col gap-1">
                <h3 class="text-xl font-bold">Administração</h3>
                <small class="text-xs">Insira suas credenciais de acesso</small>
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
            {{-- <a
                class="text-primary-500 text-sm hover:underline"
                href="{{ route('forgot-password.index') }}"
            >
                Esqueceu a senha?
            </a> --}}
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
                    href="{{ route('auth.registration.index') }}"
                >
                    Ainda não tem cadastro?
                </a>
            </div>
        </x-slot> --}}
    </x-system.auth-layout>
</x-app-layout>
