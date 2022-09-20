<?php

namespace App\Http\Livewire\Tenant\Users;

use App\Models\Person;
use Livewire\Component;

use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;

class Edit extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public User $user;
    public Person $person;

    protected function getUserFormModel(): User
    {
        return $this->user;
    }

    public function mount($user): void
    {
        $this->user = $user;
        // $this->person = $user->person;

        $this->userForm->fill([
            'name' => $this->user->name,
            'email' => $this->user->email,
        ]);

        // $this->personForm->fill([
        //     'name' => $this->person->name,
        //     'birthday' => $this->person->birthday,
        //     'gender' => $this->person->gender,
        //     'picture' => $this->person->picture,
        // ]);
    }

    protected function getUserFormSchema(): array
    {
        $form = [
            Components\Card::make([
                Components\TextInput::make('name')
                    ->label('Nome')
                    ->required(),
                Components\TextInput::make('email')
                    ->label('Email')
                    ->unique('users', 'email', $this->user)
                    ->email()
                    ->required(),
                Components\TextInput::make('password')
                    ->label('Senha')
                    ->password()
                    ->required()
            ])
        ];

        return $form;
    }

    protected function getPersonFormSchema(): array
    {
        $form = [
            Components\DatePicker::make('birthday')
                ->format('d/m/Y')
                ->displayFormat("d/m/Y")
                ->label('Data de nascimento')
                ->required(),
            Components\Select::make('gender')
                ->options([
                    'Masculino' => 'Masculino',
                    'Feminino' => 'Feminino'
                ])
                ->label('Gênero')
                ->required(),
            Components\Select::make('ecclesiastical_role_id')
                ->label('Cargo Eclesiástico')
                ->relationship('ecclesiasticalRole', 'name'),
            Components\FileUpload::make('picture')
                ->label('Imagem')
        ];

        return $form;
    }

    protected function getForms(): array
    {
        return [
            'userForm' => $this->makeForm()
                ->schema($this->getUserFormSchema())
                ->model($this->user),
            // 'personForm' => $this->makeForm()
            //     ->schema($this->getPersonFormSchema())
            //     ->model($this->person),
        ];
    }

    public function submit(): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $userForm = $this->userForm->getState();
        // $personForm = $this->personForm->getState();

        $userForm['password'] = bcrypt($userForm['password']);

        $this->user->fill($userForm)->save();
        // $this->user->person->fill([
        //     'name' => $this->user->name,
        //     ...$personForm
        // ]);
        // $this->user->push();

        Notification::make()
            ->title('Informações do usuário atualizadas com sucesso!')
            ->success()
            ->send();

        return redirect(tenantRoute('users.index'));
    }

    public function render(): View
    {
        return view('livewire.tenant.users.edit')
            ->layout('tenant.layouts.dashboard-layout');
    }
}
