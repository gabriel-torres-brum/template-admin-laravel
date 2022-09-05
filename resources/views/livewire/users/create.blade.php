@push('title', 'Incluir usuário')

<form wire:submit.prevent="submit">
    <div class="mb-6">
        {{ $this->form }}
    </div>

    <div class="flex gap-4">
        <x-button
            class="mt-4"
            type="submit"
            spinner="submit"
            icon="check"
            positive
        >
            Novo usuário
        </x-button>
    </div>
</form>
