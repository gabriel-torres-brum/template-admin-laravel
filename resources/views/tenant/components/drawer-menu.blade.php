<div class="overflow-y-auto py-4">
    <ul class="space-y-2">
        <x-drawer-menu-link
            route="dashboard"
            icon="home"
            label="Início"
        />
        <x-drawer-menu-link
            icon="user"
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
    </ul>
</div>
