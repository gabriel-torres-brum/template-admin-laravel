@push('title', 'Incluir usuário')

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
        {{ $this->userForm }}
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