@push('title', 'Editar usuário')

<x-tenant.dashboard-layout>
    <form wire:submit.prevent="submit">
        <div class="mb-6">
            {{ $this->form }}
        </div>

        <x-button
            class="w-full sm:w-auto"
            type="submit"
            spinner="submit"
            icon="check"
            positive
        >
            Concluir edição
        </x-button>
    </form>
</x-tenant.dashboard-layout>
