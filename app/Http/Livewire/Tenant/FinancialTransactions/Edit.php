<?php

namespace App\Http\Livewire\Tenant\FinancialTransactions;

use App\Models\FinancialTransaction;
use Livewire\Component;

use Filament\Forms;
use Filament\Forms\Components;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Livewire\TemporaryUploadedFile;

class Edit extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public FinancialTransaction $financialTransaction;

    protected function getFormModel(): FinancialTransaction
    {
        return $this->financialTransaction;
    }

    public function mount($financialTransaction): void
    {
        $this->financialTransaction = $financialTransaction;

        $this->form->fill([
            'type' => $this->financialTransaction->type,
            'description' => $this->financialTransaction->description,
            'value' => $this->financialTransaction->value,
            'payment_method' => $this->financialTransaction->payment_method,
            'status' => $this->financialTransaction->status,
        ]);
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
                    ->visible(fn ($get) => $this->financialTransaction->type ?? $get('type') === '2')
                    ->placeholder('Ex.: Dinheiro / PIX / Cartão De Crédito')
                    ->required(),
                Components\Select::make('status')
                    ->label('Status')
                    ->visible(fn ($get) => $this->financialTransaction->type ?? $get('type') === '2')
                    ->options([
                        1 => 'Em aberto',
                        2 => 'Pago'
                    ])
                    ->required(),
                Components\SpatieMediaLibraryFileUpload::make('financial_transactions_invoice')
                    ->label('Anexar nota fiscal')
                    ->visible(fn ($get) => $this->financialTransaction->type ?? $get('type') === '2')
                    ->collection('financial_transactions_invoices')
                    ->enableDownload()
                    ->enableOpen()
                    ->visibility('private')
                    ->disk('s3'),
            ])
        ];

        return $form;
    }

    public function submit(): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $form = $this->form->getState();

        $financialTransaction = $this->financialTransaction->fill($form)->save();

        $this->form->model($financialTransaction)->saveRelationships();

        Notification::make()
            ->title('Transação financeira adicionada com sucesso!')
            ->success()
            ->send();

        return redirect(tenantRoute('financialTransactions.index'));
    }

    public function render(): View
    {
        return view('livewire.tenant.financial-transactions.edit')
            ->layout('tenant.layouts.dashboard-layout');
    }
}
