<?php

namespace App\Http\Livewire\Tenant\FinancialTransactions;

use Livewire\Component;

use App\Models\FinancialTransactions;
use Filament\Forms;
use Filament\Forms\Components;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Livewire\TemporaryUploadedFile;

class Create extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected function getFormModel(): string
    {
        return FinancialTransactions::class;
    }

    public function mount(): void
    {
        $this->form->fill();
    }

    protected function getFormSchema(): array
    {
        $form = [
            Components\Card::make([
                Components\Repeater::make('financialTransactions')
                    ->label('')
                    ->createItemButtonLabel('Adicionar item')
                    ->schema([
                        Components\Select::make('type')
                            ->label('Tipo')
                            ->reactive()
                            ->options([
                                1 => 'Entrada',
                                2 => 'Saída',
                            ])
                            ->required()
                            ->columnSpan(2),
                        Components\TextInput::make('description')
                            ->label('Descrição')
                            ->required(),
                        Components\TextInput::make('value')
                            ->label('Valor')
                            ->prefix('R$')
                            ->mask(
                                fn (Components\TextInput\Mask $mask) => $mask
                                    ->numeric()
                                    ->decimalPlaces(2)
                                    ->padFractionalZeros()
                                    ->normalizeZeros(false)
                                    ->thousandsSeparator('.')
                                    ->decimalSeparator(',')
                            )
                            ->required(),
                        Components\TextInput::make('payment_method')
                            ->label('Forma de pagamento')
                            ->visible(fn ($get) => $get('type') === '2')
                            ->placeholder('Ex.: Dinheiro / PIX / Cartão De Crédito')
                            ->required(),
                        Components\Select::make('status')
                            ->label('Status')
                            ->visible(fn ($get) => $get('type') === '2')
                            ->options([
                                1 => 'Em aberto',
                                2 => 'Pago'
                            ])
                            ->required(),
                        Components\FileUpload::make('invoice')
                            ->label('Anexar nota fiscal')
                            ->visible(fn ($get) => $get('type') === '2')
                            ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file) {
                                return str($file->generateHashNameWithOriginalNameEmbedded($file))
                                ->prepend('tenants/' .tenant()->getTenantKey() . '/financialTransactions/' . now()->format('Y-m-d') . '/');
                            })
                            ->columnSpan(2),
                    ])
                    ->columns(2)
            ])
        ];

        return $form;
    }

    public function submit(): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $form = $this->form->getState();

        foreach ($form['financialTransactions'] as $financialTransaction) {
            if (empty($financialTransaction['invoice'])) {
                unset($financialTransaction['invoice']);
            }
                
            FinancialTransactions::create($financialTransaction);
        }

        $notificationTitle = count($form['financialTransactions']) > 1
            ? 'Transação financeira adicionada com sucesso!'
            : 'Transações financeiras adicionadas com sucesso!';

        Notification::make()
            ->title($notificationTitle)
            ->success()
            ->send();

        return redirect(tenantRoute('financialTransactions.index'));
    }

    public function render(): View
    {
        return view('livewire.tenant.financial-transactions.create')
            ->layout('tenant.layouts.dashboard-layout');
    }
}
