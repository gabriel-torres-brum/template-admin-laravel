<?php

namespace App\Http\Livewire\Tenant\Users;

use App\Models\Person;
use Livewire\Component;

use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;

class Create extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public User $user;
    public Person $person;

    protected function getUserFormModel(): string
    {
        return User::class;
    }

    protected function getPersonFormModel(): string
    {
        return Person::class;
    }

    public function mount(): void
    {
        $this->user = new User;
        $this->person = new Person;

        $this->userForm->fill();
        $this->personForm->fill();
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
                    ->unique()
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
            'personForm' => $this->makeForm()
                ->schema($this->getPersonFormSchema())
                ->model($this->person),
        ];
    }

    public function submit(): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $userForm = $this->userForm->getState();

        $userForm['password'] = bcrypt($userForm['password']);

        $user = $this->user->create($userForm);

        // $personForm = $this->personForm->getState();
        // $this->person->create([
        //     'name' => $user->name,
        //     ...$personForm,
        //     'user_id' => $user->id
        // ]);

        Notification::make()
            ->title('Usuário adicionado com sucesso!')
            ->success()
            ->send();

        return redirect()->route('users.index');
    }

    public function render(): View
    {
        return view('livewire.tenant.users.create')
            ->layout('tenant.layouts.dashboard-layout');
    }
}
