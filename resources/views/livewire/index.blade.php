@push('title', 'Página inicial')

<div>
    <header
        class="bg-white dark:bg-gray-800 flex h-24 w-full items-center justify-between border-b border-gray-200 px-6 dark:border-gray-500"
    >
        <x-app-logo class="h-12" />
        <x-button.circle
            x-on:click.prevent="darkMode = !darkMode"
            white
        >
            <x-slot name="label">
                <x-icon
                    class="w-6 h-6"
                    name="moon"
                    solid
                />
            </x-slot>
        </x-button.circle>
    </header>
    <div
        class="flex h-80 items-center justify-center bg-gray-200 dark:bg-gray-700">
        <div class="flex flex-col gap-2 p-6">
            <h5 class="text-2xl font-extrabold tracking-tight text-center">
                Sistema de gerenciamento para igrejas
            </h5>
            <x-select
                placeholder="Selecione sua igreja para fazer login"
                :options="$tenants"
                description="Teste"
                option-value="id"
                option-label="name"
                wire:model="tenant"
            />
            <x-button
                label="Acesse o Sistema"
                right-icon="external-link"
                wire:click="redirectToTenantDomain()"
                primary
            />
        </div>
    </div>
</div>
