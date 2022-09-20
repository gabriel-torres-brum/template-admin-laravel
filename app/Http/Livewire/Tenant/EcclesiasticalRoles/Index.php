<?php

namespace App\Http\Livewire\Tenant\EcclesiasticalRoles;

use App\Models\EcclesiasticalRole;
use Livewire\Component;

use Filament\Tables;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;

class Index extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        return EcclesiasticalRole::query();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('created_at')
                ->date('d/m/Y H:i')
                ->label('Data de criação')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('name')
                ->label('Título do cargo')
                ->sortable()
                ->searchable(),
            Tables\Columns\BadgeColumn::make('gender')
                ->label('Gênero')
                ->sortable()
                ->searchable(),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Tables\Actions\EditAction::make('editar')
                ->icon('heroicon-o-pencil')
                ->url(fn (EcclesiasticalRole $record): string => tenantRoute('ecclesiasticalRoles.edit', ['ecclesiasticalRole' => $record])),
            Tables\Actions\DeleteAction::make('excluir')
                ->modalHeading('Excluir usuário')
                ->icon('heroicon-o-trash')
                ->action(fn (EcclesiasticalRole $record) => $record->delete())
        ];
    }

    protected function getTableBulkActions(): array
    {
        return [
            Tables\Actions\BulkAction::make('excluir')
                ->label('Excluir selecionados')
                ->color('danger')
                ->action(function (Collection $records): void {
                    foreach ($records as $record) {
                        $record->delete();
                    }
                })
                ->requiresConfirmation(),
        ];
    }
    public function render(): View
    {
        return view('livewire.tenant.ecclesiastical-roles.index')
            ->layout('tenant.layouts.dashboard-layout');
    }
}
