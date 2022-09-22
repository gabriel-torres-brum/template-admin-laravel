@push('title', 'Início')

<div>
    <h5 class="text-lg font-extrabold uppercase tracking-tight">
        {{ tenant()->name }}
    </h5>

    <span class="text-lg">
        {{ $dashboardText }}
    </span>
    <x-divider class="mt-2 mb-6 dark:border-gray-800" />
    <div class="gap-4 flex flex-col">
        <h5 class="tracking-tight font-extrabold">Administrativo</h5>
        <div class="grid grid-cols-12 gap-4">
            <x-dashboard-card
                class="col-span-12 bg-cyan-300 dark:!bg-cyan-800 md:col-span-6 lg:col-span-4"
                route="people.index"
            >
                <x-slot name="header">
                    <div class="flex items-center gap-3">
                        <x-icon
                            class="h-10 w-10"
                            name="users"
                            solid
                        />
                        <span class="text-lg">Membros</span>
                    </div>
                </x-slot>
                <x-slot name="footer">
                    Acesse a listagem de membros registrados no sistema.
                </x-slot>
            </x-dashboard-card>
            <x-dashboard-card
                class="col-span-12 bg-purple-300 dark:!bg-purple-800 md:col-span-6 lg:col-span-4"
                route="people.index"
            >
                <x-slot name="header">
                    <div class="flex items-center gap-3">
                        <x-icon
                            class="h-10 w-10"
                            name="user-circle"
                            solid
                        />
                        <span class="text-lg">Usuários</span>
                    </div>
                </x-slot>
                <x-slot name="footer">
                    Acesse a listagem de usuários registrados no sistema.
                </x-slot>
            </x-dashboard-card>
            <x-dashboard-card
                class="col-span-12 bg-fuchsia-300 dark:!bg-fuchsia-800 md:col-span-6 lg:col-span-4"
                route="config"
            >
                <x-slot name="header">
                    <div class="flex items-center gap-3">
                        <x-icon
                            class="h-10 w-10"
                            name="cog"
                            solid
                        />
                        <span class="text-lg">Editar informações da
                            igreja</span>
                    </div>
                </x-slot>
                <x-slot name="footer">
                    Edite as informações da sua igreja
                </x-slot>
            </x-dashboard-card>
        </div>
    </div>
    <div class="mt-2 mb-6"></div>
    <div class="gap-4 flex flex-col">
        <h5 class="tracking-tight font-extrabold">Financeiro</h5>
        <div class="grid grid-cols-12">
            <x-dashboard-card
                class="col-span-12 bg-teal-300 dark:!bg-teal-800 md:col-span-6 lg:col-span-4"
                route="financialTransactions.index"
            >
                <x-slot name="header">
                    <div class="flex items-center gap-3">
                        <x-icon
                            class="h-10 w-10"
                            name="currency-dollar"
                            solid
                        />
                        <span class="text-lg">Transações</span>
                    </div>
                </x-slot>
                <x-slot name="footer">
                    Acesse as transações realizadas
                </x-slot>
            </x-dashboard-card>
        </div>
    </div>
</div>
