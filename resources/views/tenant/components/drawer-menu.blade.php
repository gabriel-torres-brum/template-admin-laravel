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
                    route="users.*"
                >
                    <x-slot name="dropdown">
                        <x-drawer-menu-dropdown-link
                            label="Lista de usuários"
                            route="users.index"
                        />
                        <x-drawer-menu-dropdown-link
                            label="Incluir usuário"
                            route="users.create"
                        />
                    </x-slot>
                </x-drawer-menu-link>

                <x-drawer-menu-link
                    icon="users"
                    label="Membros"
                    route="people.*"
                >
                    <x-slot name="dropdown">
                        <x-drawer-menu-dropdown-link
                            label="Lista de membros"
                            route="people.index"
                        />
                        <x-drawer-menu-dropdown-link
                            label="Incluir membro"
                            route="people.create"
                        />
                    </x-slot>
                </x-drawer-menu-link>

                <x-drawer-menu-link
                    icon="identification"
                    label="Cargos eclesiásticos"
                    route="ecclesiasticalRoles.*"
                >
                    <x-slot name="dropdown">
                        <x-drawer-menu-dropdown-link
                            label="Lista de cargos eclesiásticos"
                            route="ecclesiasticalRoles.index"
                        />
                        <x-drawer-menu-dropdown-link
                            label="Incluir cargo eclesiástico"
                            route="ecclesiasticalRoles.create"
                        />
                    </x-slot>
                </x-drawer-menu-link>
            </x-slot>
        </x-drawer-menu-link>
    </ul>
</div>
