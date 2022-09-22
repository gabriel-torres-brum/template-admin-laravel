<?php

namespace App\Http\Livewire\Tenant\FinancialTransactions;

use App\Models\FinancialTransaction;
use Filament\Notifications\Notification;
use Livewire\Component;

use Filament\Tables;
use Filament\Forms;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class Index extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable, Forms\Concerns\InteractsWithForms;

    protected function getTableQuery(): Builder
    {
        return FinancialTransaction::query()
            ->orderByRaw("status = '3' ASC");
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
            Tables\Columns\TextColumn::make('value')
                ->prefix('R$')
                ->formatStateUsing(fn ($state) => number_format($state, 2, ',', '.'))
                ->label('Valor')
                ->sortable()
                ->searchable(),
            Tables\Columns\BadgeColumn::make('type')
                ->label('Tipo de transação')
                ->getStateUsing(function ($record) {
                    if ($record->type === 1) {
                        return 'Entrada';
                    }

                    if ($record->type === 2) {
                        return 'Saída';
                    }
                })
                ->color(function ($record) {
                    if ($record->type === 1) {
                        return 'success';
                    }

                    if ($record->type === 2) {
                        return 'danger';
                    }
                })
                ->sortable()
                ->searchable(),
            Tables\Columns\BadgeColumn::make('payment_method')
                ->label('Forma de pagamento')
                ->color('primary')
                ->sortable()
                ->searchable(),
            Tables\Columns\BadgeColumn::make('status')
                ->label('Status')
                ->getStateUsing(function ($record) {
                    if ($record->status === 1) {
                        return 'Em aberto';
                    }

                    if ($record->status === 2) {
                        return 'Pago';
                    }

                    if ($record->status === 3) {
                        return 'Anulado';
                    }
                })
                ->color(function ($record) {
                    if ($record->status === 1) {
                        return 'warning';
                    }

                    if ($record->status === 2) {
                        return 'success';
                    }

                    if ($record->status === 3) {
                        return 'danger';
                    }
                })
                ->sortable()
                ->searchable(),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Tables\Actions\Action::make('comprovante')
                ->icon('heroicon-o-paper-clip')
                ->disabled()
                ->visible(fn (FinancialTransaction $record) => count($record->media->toArray() ?? []) > 0),
            Tables\Actions\Action::make('visualizar')
                ->icon('heroicon-o-eye')
                ->url(fn (FinancialTransaction $record): string => tenantRoute('financialTransactions.edit', ['financialTransaction' => $record])),
            Tables\Actions\Action::make('anular')
                ->modalHeading('Anular transação financeira')
                ->modalButton('Anular')
                ->modalSubheading('Deseja realmente anular essa transação financeira?')
                ->icon('heroicon-s-ban')
                ->color('danger')
                ->requiresConfirmation()
                ->action(function (FinancialTransaction $record) {
                    $record->delete();
                    Notification::make()
                        ->title('Transação financeira anulada com sucesso!')
                        ->success()
                        ->send();
                })
        ];
    }

    protected function getTableBulkActions(): array
    {
        return [
            Tables\Actions\BulkAction::make('anular')
                ->label('Anular selecionados')
                ->color('warning')
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
        return view('livewire.tenant.financial-transactions.index')
            ->layout('tenant.layouts.dashboard-layout');
    }
}
