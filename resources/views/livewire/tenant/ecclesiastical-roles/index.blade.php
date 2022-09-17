@push('title', 'Lista de cargos eclesiásticos')

<div class="flex flex-col justify-center gap-4">
    <div class="flex justify-end">
        <x-button
            href="{{ route('ecclesiasticalRoles.create') }}"
            label="Adicionar cargo eclesiástico"
            primary
            class="w-full sm:w-auto"
        />
    </div>
    <div class="overflow-hidden">
        {{ $this->table }}
    </div>
</div>
