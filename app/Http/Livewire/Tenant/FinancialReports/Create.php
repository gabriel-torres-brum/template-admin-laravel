<?php

namespace App\Http\Livewire\Tenant\FinancialReports;

use Livewire\Component;

use App\Models\FinancialReport;
use App\Models\FinancialTransaction;
use Filament\Forms;
use Filament\Forms\Components;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Livewire\TemporaryUploadedFile;

class Create extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected function getFormModel(): string
    {
        return FinancialReport::class;
    }

    public function mount(): void
    {
        $this->form->fill();
    }

    protected function getFormSchema(): array
    {
        $form = [
            Components\Card::make([
                Components\TextInput::make('description')
                    ->label('Descrição')
                    ->required(),
                Components\DatePicker::make('begin_period')
                    ->format('Y-m-d')
                    ->withoutTime()
                    ->displayFormat("d/m/Y")
                    ->label('Período (Início)')
                    ->required(),
                Components\DatePicker::make('final_period')
                    ->format('Y-m-d')
                    ->withoutTime()
                    ->displayFormat("d/m/Y")
                    ->label('Período (Final)')
            ])
        ];

        return $form;
    }

    public function submit(): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Support\MessageBag
    {
        $form = $this->form->getState();

        $form['final_period'] = $form['final_period'] ?? now()->format('Y-m-d');

        $financialTransactions = FinancialTransaction::query()->whereBetween(
            DB::raw('DATE(created_at)'),
            [$form['begin_period'], $form['final_period']]
        )->get();

        if (!(count($financialTransactions) > 0)) {
            return $this->addError(
                'error',
                "Nenhuma transação financeira foi encontrada no período especificado"
            );
        }

        $financialReport = FinancialReport::create($form);

        $financialReport->financialTransactions()
            ->attach(
                $financialTransactions
                    ->pluck('id')
                    ->toArray()
            );

        Notification::make()
            ->title('Relatório financeiro criado com sucesso!')
            ->success()
            ->send();

        return redirect(tenantRoute('financialReports.index'));
    }

    public function render()
    {
        return view('livewire.tenant.financial-reports.create')
            ->layout('tenant.layouts.dashboard-layout');
    }
}
