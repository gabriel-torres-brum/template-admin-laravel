<?php

namespace App\Http\Livewire\Tenant\EcclesiasticalRoles;

use App\Models\EcclesiasticalRole;
use Livewire\Component;

use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;

class Create extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected function getFormModel(): string
    {
        return EcclesiasticalRole::class;
    }

    public function mount(): void
    {
        $this->form->fill();
    }

    protected function getFormSchema(): array
    {
        $form = [
            Components\Card::make([
                Components\TextInput::make('name')
                    ->label('Título do cargo')
                    ->unique()
                    ->required(),
                Components\Select::make('gender')
                    ->label('Gênero')
                    ->options([
                        'Ambos' => 'Ambos',
                        'Masculino' => 'Masculino',
                        'Feminino' => 'Feminino',
                    ])
                    ->required()
            ]),
        ];

        return $form;
    }

    public function submit(): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $form = $this->form->getState();

        EcclesiasticalRole::create($form);

        Notification::make()
            ->title('Cargo eclesiástico adicionado com sucesso!')
            ->success()
            ->send();

        return redirect()->route('ecclesiasticalRoles.index');
    }

    public function render(): View
    {
        return view('livewire.tenant.ecclesiastical-roles.create')
            ->layout('tenant.layouts.dashboard-layout');
    }
}
