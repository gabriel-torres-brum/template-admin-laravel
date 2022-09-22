<div class="overflow-y-auto py-4">
    <ul class="space-y-2">
        <x-drawer-menu-link
            route="dashboard"
            icon="home"
            label="Início"
        />

        <x-drawer-menu-link
            icon="user-group"
            label="Administrativo"
        >
            <x-slot name="dropdown">
                <x-drawer-menu-link
                    icon="user-circle"
                    label="Usuários"
                    route="users.index"
                />

                <x-drawer-menu-link
                    icon="users"
                    label="Membros"
                    route="people.index"
                />

                <x-drawer-menu-link
                    icon="identification"
                    label="Cargos eclesiásticos"
                    route="ecclesiasticalRoles.index"
                />
            </x-slot>
        </x-drawer-menu-link>

        <x-drawer-menu-link
            icon="banknotes"
            label="Financeiro"
        >
            <x-slot name="dropdown">
                <x-drawer-menu-link
                    icon="currency-dollar"
                    label="Transações Financeiras"
                    route="financialTransactions.index"
                />
                <x-drawer-menu-link
                    icon="clipboard-document"
                    label="Relatórios Financeiros"
                    route="financialReports.index"
                />
            </x-slot>
        </x-drawer-menu-link>
    </ul>
</div>
