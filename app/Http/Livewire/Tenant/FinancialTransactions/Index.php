<?php

namespace App\Http\Livewire\Tenant\FinancialTransactions;

use App\Models\FinancialTransactions;
use Filament\Notifications\Notification;
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
        return FinancialTransactions::query()
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
            // Tables\Columns\BadgeColumn::make('gender')
            //     ->label('Gênero')
            //     ->sortable()
            //     ->searchable(),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Tables\Actions\Action::make('Comprovante')
                ->icon('heroicon-s-download')
                ->visible(fn (FinancialTransactions $record) => is_file(storage_path("app/public/tenants/" . tenant()->getTenantKey() . "{$record->invoice}")))
                ->color('primary')
                ->action(function (FinancialTransactions $record) {
                    if ($record->invoice) {
                        $fileExtension = pathinfo(storage_path("app/public/tenants/" . tenant()->getTenantKey() . "{$record->invoice}"), PATHINFO_EXTENSION);
                        $description = str($record->description)->slug('_');
                        return response()
                            ->download(
                                storage_path("app/public/tenants/" . tenant()->getTenantKey() . "{$record->invoice}"),
                                "{$record->created_at->format('Y-m-d_H-i-s')}_{$description}_comprovante_transacao_financeira.{$fileExtension}"
                            );
                    }
                }),
            Tables\Actions\Action::make('anular')
                ->modalHeading('Anular transação financeira')
                ->modalButton('Anular')
                ->modalSubheading('Deseja realmente anular essa transação financeira?')
                ->icon('heroicon-s-ban')
                ->color('danger')
                ->requiresConfirmation()
                ->action(function (FinancialTransactions $record) {
                    // $record->status = 3;
                    // $record->save();
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
                        // $record->status = 3;
                        // $record->save();
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
