@push('title', 'Lista de usuários')

<div class="flex flex-col justify-center gap-4">
    <div class="flex justify-end">
        <x-button
            href="{{ route('users.create') }}"
            label="Adicionar usuário"
            primary
            class="w-full sm:w-auto"
        />
    </div>
    <div class="overflow-hidden">
        {{ $this->table }}
    </div>
</div>
