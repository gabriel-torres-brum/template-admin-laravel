@push('title', 'Criar relatório financeiro')

<form wire:submit.prevent="submit">
    <x-button
        type="submit"
        spinner
        icon="check"
        positive
    >
        Salvar
    </x-button>
    <x-divider class="my-5 border-none" />
    <div class="flex flex-col gap-6">
        <x-errors only="error" title="Não foi possível criar o relatório." />
        {{ $this->form }}
    </div>
    <x-divider class="my-5 border-none" />
    <x-button
        type="submit"
        spinner
        icon="check"
        positive
    >
        Salvar
    </x-button>

</form>
