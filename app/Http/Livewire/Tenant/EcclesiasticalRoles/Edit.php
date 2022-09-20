<?php

namespace App\Http\Livewire\Tenant\EcclesiasticalRoles;

use App\Models\EcclesiasticalRole;
use Livewire\Component;

use Filament\Forms;
use Filament\Forms\Components;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;

class Edit extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public EcclesiasticalRole $ecclesiasticalRole;

    protected function getFormModel(): EcclesiasticalRole
    {
        return $this->ecclesiasticalRole;
    }

    public function mount($ecclesiasticalRole): void
    {
        $this->ecclesiasticalRole = $ecclesiasticalRole;

        $this->form->fill([
            'name' => $this->ecclesiasticalRole->name,
            'gender' => $this->ecclesiasticalRole->gender,
        ]);
    }

    protected function getFormSchema(): array
    {
        $form = [
            Components\Card::make([
                Components\TextInput::make('name')
                    ->label('Título do cargo')
                    ->required(),
                Components\Select::make('gender')
                    ->label('Gênero')
                    ->options([
                        'Ambos' => 'Ambos',
                        'Masculino' => 'Masculino',
                        'Feminino' => 'Feminino',
                    ])
                    ->required(),
            ])
        ];

        return $form;
    }

    public function submit(): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $form = $this->form->getState();

        $this->ecclesiasticalRole->fill($form)->save();

        Notification::make()
            ->title('Informações do cargo eclesiástico atualizadas com sucesso!')
            ->success()
            ->send();

        return redirect(tenantRoute('ecclesiasticalRoles.index'));
    }

    public function render(): View
    {
        return view('livewire.tenant.ecclesiastical-roles.edit')
            ->layout('tenant.layouts.dashboard-layout');
    }
}
