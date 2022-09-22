@push('title', 'Relatórios financeiros')

<div class="flex flex-col justify-center gap-4">
    <div class="flex justify-end">
        <x-button
            href="{{ tenantRoute('financialReports.create') }}"
            label="Criar relatório financeiro"
            primary
            class="w-full sm:w-auto"
        />
    </div>
    <div class="overflow-hidden">
        {{ $this->table }}
    </div>
</div>
