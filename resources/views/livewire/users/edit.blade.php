@push('title', 'Editar usuário')

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
