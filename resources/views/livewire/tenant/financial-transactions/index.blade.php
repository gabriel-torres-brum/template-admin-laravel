@push('title', 'Transações financeiras')

<div class="flex flex-col justify-center gap-4">
    <div class="flex justify-end">
        <x-button
            href="{{ tenantRoute('financialTransactions.create') }}"
            label="Incluir transação financeira"
            primary
            class="w-full sm:w-auto"
        />
    </div>
    <div class="overflow-hidden">
        {{ $this->table }}
    </div>
</div>
