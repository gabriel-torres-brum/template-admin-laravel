<?php

namespace App\Http\Livewire\Tenant\FinancialTransactions;

use Livewire\Component;

use App\Models\FinancialTransaction;
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
        return FinancialTransaction::class;
    }

    public function mount(): void
    {
        $this->form->fill();
    }

    protected function getFormSchema(): array
    {
        $form = [
            Components\Card::make([
                Components\Select::make('type')
                    ->label('Tipo')
                    ->reactive()
                    ->options([
                        1 => 'Entrada',
                        2 => 'Saída',
                    ])
                    ->required(),
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
                Components\SpatieMediaLibraryFileUpload::make('financial_transactions_invoice')
                    ->label('Anexar nota fiscal')
                    ->visible(fn ($get) => $get('type') === '2')
                    ->collection('financial_transactions_invoices')
                    ->visibility('private')
                    ->disk('s3'),
            ])
        ];

        return $form;
    }

    public function submit(): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $form = $this->form->getState();

        $financialTransactions = FinancialTransaction::create($form);

        $this->form->model($financialTransactions)->saveRelationships();

        Notification::make()
            ->title('Transação financeira adicionada com sucesso!')
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
