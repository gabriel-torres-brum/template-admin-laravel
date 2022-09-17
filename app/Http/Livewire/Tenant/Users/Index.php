<?php

namespace App\Http\Livewire\Tenant\Users;

use App\Models\User;
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
        $users = User::query();
        
        $users->orderByRaw("id = '" . auth()->id() . "' DESC");
        
        return $users->latest();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('created_at')
                ->date('d/m/Y H:i')
                ->label('Data de Criação')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('name')
                ->label('Nome')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('email')
                ->label('Email')
                ->sortable()
                ->searchable(),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Tables\Actions\EditAction::make('editar')
                ->icon('heroicon-o-pencil')
                ->url(fn (User $record): string => route('users.edit', ['user' => $record])),
            Tables\Actions\DeleteAction::make('excluir')
                ->hidden(fn (User $record) => $record->id === auth()->id())
                ->modalHeading('Excluir usuário')
                ->icon('heroicon-o-trash')
                ->action(fn (User $record) => $record->id !== auth()->id() ? $record->delete() : null)
        ];
    }

    protected function getTableBulkActions(): array
    {
        return [
            Tables\Actions\BulkAction::make('excluir')
                ->label('Excluir selecionados')
                ->color('danger')
                ->hidden(fn (User $record) => $record->id === auth()->id())
                ->action(function (Collection $records): void {
                    foreach ($records as $record) {
                        if ($record->id !== auth()->id()) {
                            $record->delete();
                        }
                    }
                })
                ->requiresConfirmation(),
        ];
    }
    public function render(): View
    {
        return view('livewire.tenant.users.index')
            ->layout('tenant.layouts.dashboard-layout');
    }
}
