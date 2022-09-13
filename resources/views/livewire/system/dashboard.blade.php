@push('title', 'Início')

<x-system.dashboard-layout>
    <div>
        <span class="text-lg">
            {{ $dashboardText }}
        </span>
        <div class="mt-2 mb-6"></div>
        <div class="grid grid-cols-12 gap-4">
            {{-- <x-dashboard-card
                route="quotations.index"
                class="col-span-12 md:col-span-6 lg:col-span-4"
            >
                <x-slot name="header">
                    <div class="flex items-center gap-3">
                        <x-icon
                            name="globe-alt"
                            class="h-10 w-10"
                        />
                        <span class="text-lg">Cotações</span>
                    </div>
                </x-slot>
                <x-slot name="footer">
                    Veja a lista de cotações realizadas
                </x-slot>
            </x-dashboard-card> --}}
        </div>
    </div>
</x-system.dashboard-layout>
