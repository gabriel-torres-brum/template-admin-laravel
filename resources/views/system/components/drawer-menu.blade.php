<div class="overflow-y-auto py-2">
    <ul class="space-y-2">
        <x-drawer-menu-link
            route="admin.dashboard"
            icon="home"
            label="Início"
        />
        {{-- <x-tenant.drawer-menu-link
            icon="user"
            label="Usuários"
            route="users.*"
        >
            <x-slot name="dropdown">
                <x-tenant.drawer-menu-dropdown-link
                    label="Lista de usuários"
                    route="users.index"
                />
                <x-tenant.drawer-menu-dropdown-link
                    label="Incluir usuário"
                    route="users.create"
                />
            </x-slot>
        </x-tenant.drawer-menu-link> --}}
    </ul>
</div>
