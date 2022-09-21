<?php

namespace App\Http\Livewire\Tenant\People;

use App\Http\Services\ViaCepService;
use App\Models\EcclesiasticalRole;
use App\Models\Person;
use Livewire\Component;

use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Livewire\TemporaryUploadedFile;

class Create extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public Person $person;

    protected function getPersonFormModel(): string
    {
        return Person::class;
    }

    public function mount(): void
    {
        $this->person = new Person;

        $this->personForm->fill();
    }

    protected function getPersonFormSchema(): array
    {
        $form = [
            Components\Card::make([
                Components\SpatieMediaLibraryFileUpload::make('people_picture')
                    ->label('Foto')
                    ->collection('people_pictures')
                    ->image()
                    ->enableDownload()
                    ->enableOpen()
                    ->visibility('private')
                    ->disk('s3'),
                Components\TextInput::make('name')
                    ->label('Nome')
                    ->lazy()
                    ->unique()
                    ->required(),
                Components\Select::make('gender')
                    ->options([
                        'Masculino' => 'Masculino',
                        'Feminino' => 'Feminino'
                    ])
                    ->lazy()
                    ->label('Gênero')
                    ->required(),
                Components\DatePicker::make('birthday')
                    ->format('Y-m-d')
                    ->displayFormat("d/m/Y")
                    ->label('Data de nascimento')
                    ->required(),
                Components\Select::make('marital_status')
                    ->options([
                        'Solteiro(a)' => 'Solteiro(a)',
                        'Casado(a)' => 'Casado(a)',
                        'Viuvo(a)' => 'Viuvo(a)',
                        'Divorciado(a)' => 'Divorciado(a)',
                    ])
                    ->label('Estado Civil')
                    ->required(),
                Components\TextInput::make('mother_name')
                    ->label('Nome da mãe'),
                Components\TextInput::make('father_name')
                    ->label('Nome do pai'),
                Components\TextInput::make('birthplace')
                    ->label('Naturalidade'),
                Components\TextInput::make('church_from')
                    ->label('Igreja procedente'),
                Components\DatePicker::make('receipt_date')
                    ->format('Y-m-d')
                    ->displayFormat("d/m/Y")
                    ->label('Data de recebimento'),
                Components\DatePicker::make('affiliation_date')
                    ->format('Y-m-d')
                    ->displayFormat("d/m/Y")
                    ->label('Data de filiação'),
                Components\Select::make('ecclesiastical_role_id')
                    ->label('Cargo eclesiástico')
                    ->relationship('ecclesiasticalRole', 'name', function ($query, $get) {
                        if ($get('gender')) {
                            return $query
                                ->where('gender', '=', 'Ambos')
                                ->orWhere('gender', '=', $get('gender'));
                        }
                    }),
                Components\DatePicker::make('baptism_date')
                    ->format('Y-m-d')
                    ->displayFormat("d/m/Y")
                    ->dehydrated(fn ($get) => $get('is_baptized'))
                    ->visible(fn ($get) => $get('is_baptized'))
                    ->label('Data de batismo'),
                Components\Card::make([
                    Components\Toggle::make('is_tither')
                        ->label('Dizimista'),
                    Components\Toggle::make('is_baptized')
                        ->reactive()
                        ->label('Batizado(a)'),
                    Components\Toggle::make('is_in_discipline')
                        ->label('Em disciplina'),
                ]),
                Components\Card::make([
                    Components\Repeater::make('personPhones')
                        ->label('Telefones')
                        ->collapsible()
                        ->relationship('personPhones')
                        ->createItemButtonLabel('Adicionar telefone')
                        ->schema([
                            Components\TextInput::make('number')
                                ->label('Número')
                                ->extraInputAttributes(['x-mask:dynamic' => "\$input.indexOf('9', 5) === 5 ? '(99) 99999-9999' : '(99) 9999-9999'"])
                                ->required(),
                        ])
                        ->defaultItems(0)
                ])
                    ->label('Telefones'),
                Components\Card::make([
                    Components\Repeater::make('personAddresses')
                        ->label('Endereços')
                        ->collapsible()
                        ->relationship('personAddresses')
                        ->createItemButtonLabel('Adicionar endereço')
                        ->schema([
                            Components\TextInput::make('cep')
                                ->label('CEP')
                                ->mask(fn (Components\TextInput\Mask $mask) => $mask->pattern('00000-000'))
                                ->lazy()
                                ->afterStateUpdated(function ($state, $set) {
                                    $cep = preg_replace('~\D~', '', $state);

                                    if (strlen($cep) < 8) return;

                                    $viaCep = ViaCepService::consultaCEP($cep);

                                    if (!$viaCep) return;

                                    $set('address', $viaCep->logradouro);
                                    $set('district', $viaCep->bairro);
                                    $set('city', $viaCep->localidade);
                                    $set('state', $viaCep->uf);
                                })->required(),
                            Components\TextInput::make('address')
                                ->label('Logradouro')
                                ->required(),
                            Components\TextInput::make('number')
                                ->label('Número')
                                ->required(),
                            Components\TextInput::make('adjunct')
                                ->label('Complemento'),
                            Components\TextInput::make('district')
                                ->label('Bairro')
                                ->required(),
                            Components\TextInput::make('city')
                                ->label('Cidade')
                                ->required(),
                            Components\TextInput::make('state')
                                ->label('Estado')
                                ->required(),
                        ])
                        ->defaultItems(0)
                ])
                    ->label('Endereços'),
                Components\Card::make([
                    Components\Repeater::make('personEmails')
                        ->label('Emails')
                        ->collapsible()
                        ->relationship('personEmails')
                        ->createItemButtonLabel('Adicionar email')
                        ->schema([
                            Components\TextInput::make('email')
                                ->label('Email')
                                ->email()
                                ->required(),
                        ])
                        ->defaultItems(0)
                ])
                    ->label('E-mails'),
                Components\Card::make([
                    Components\Repeater::make('personDocuments')
                        ->label('Documentos')
                        ->collapsible()
                        ->relationship('personDocuments')
                        ->createItemButtonLabel('Adicionar documento')
                        ->schema([
                            Components\TextInput::make('description')
                                ->label('Tipo')
                                ->required(),
                            Components\TextInput::make('number')
                                ->label('Número')
                                ->required(),
                            Components\DatePicker::make('shipping_date')
                                ->format('Y-m-d')
                                ->displayFormat("d/m/Y")
                                ->label('Data de expedição'),
                            Components\SpatieMediaLibraryFileUpload::make('people_document_copy_picture')
                                ->label('Anexar cópia')
                                ->collection('people_document_copy_pictures')
                                ->enableDownload()
                                ->enableOpen()
                                ->visibility('private')
                                ->disk('s3'),
                        ])
                        ->defaultItems(0)
                ])
                    ->label('Documentos')
            ])
        ];

        return $form;
    }

    protected function getForms(): array
    {
        return [
            'personForm' => $this->makeForm()
                ->schema($this->getPersonFormSchema())
                ->model($this->person),
        ];
    }

    public function submit(): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $personForm = $this->personForm->getState();
        // $userForm = $this->userForm->getState();

        // $userForm['password'] = bcrypt($userForm['password']);

        // $user = $this->user->create($userForm);

        // $this->person->create([
        //     'name' => $user->name,
        //     ...$personForm,
        //     'user_id' => $user->id
        // ]);

        $person = $this->person->create($personForm);

        $this->personForm->model($person)->saveRelationships();

        Notification::make()
            ->title('Membro adicionado com sucesso!')
            ->success()
            ->send();

        return redirect(tenantRoute('people.index'));
    }

    public function render(): View
    {
        return view('livewire.tenant.people.create')
            ->layout('tenant.layouts.dashboard-layout');
    }
}
