@push('title', 'Lista de membros')

<div class="flex flex-col justify-center gap-4">
    <div class="flex justify-end">
        <x-button
            href="{{ tenantRoute('people.create') }}"
            label="Adicionar membro"
            primary
            class="w-full sm:w-auto"
        />
    </div>
    <div class="overflow-hidden">
        {{ $this->table }}
    </div>
</div>
