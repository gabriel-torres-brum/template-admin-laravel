<?php

namespace App\Http\Livewire\Tenant\FinancialReports;

use App\Http\Livewire\Tenant\FinancialTransactions\Index as FinancialTransactionsIndex;
use App\Models\FinancialReport;
use Filament\Notifications\Notification;
use Livewire\Component;

use Filament\Tables;
use Filament\Forms;
use Filament\Tables\Table;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Collection;

class Index extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable, Forms\Concerns\InteractsWithForms;

    protected function getTableQuery(): Builder
    {
        return FinancialReport::query()
            ->latest();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('created_at')
                ->date('d/m/Y H:i')
                ->label('Data')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('description')
                ->label('Descrição')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('begin_period')
                ->label('Período (Início)')
                ->date('d/m/Y')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('final_period')
                ->date('d/m/Y')
                ->label('Período (Final)')
                ->sortable()
                ->searchable(),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Tables\Actions\ViewAction::make('visualizar')
                ->icon('heroicon-o-eye')
                ->modalHeading("Visualizar relatório financeiro")
                ->modalSubheading("Transações financeiras:"),
            Tables\Actions\Action::make('excluir')
                ->modalHeading('Excluir relatório financeiro')
                ->modalButton('Excluir')
                ->modalSubheading('Deseja realmente excluir esse relatório financeiro?')
                ->icon('heroicon-s-trash')
                ->color('danger')
                ->requiresConfirmation()
                ->action(function (FinancialReport $record) {
                    $record->delete();
                    Notification::make()
                        ->title('Relatório financeiro excluído com sucesso!')
                        ->success()
                        ->send();
                })
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
    public function render()
    {
        return view('livewire.tenant.financial-reports.index')
            ->layout('tenant.layouts.dashboard-layout');
    }
}
