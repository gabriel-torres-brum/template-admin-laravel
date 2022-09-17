<?php

namespace App\Http\Livewire\Tenant\People;

use App\Http\Services\ViaCepService;
use App\Models\Person;
use Livewire\Component;

use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Livewire\TemporaryUploadedFile;

class Edit extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public Person $person;

    protected function getPersonFormModel(): Person
    {
        return $this->person;
    }

    public function mount($person): void
    {
        $this->person = $person;

        $this->personForm->fill([
            'name' => $this->person->name,
            'gender' => $this->person->gender,
            'birthday' => $this->person->birthday,
            'marital_status' => $this->person->marital_status,
            'birthplace' => $this->person->birthplace,
            'is_baptized' => $this->person->is_baptized,
            'is_tither' => $this->person->is_tither,
            'is_in_discipline' => $this->person->is_in_discipline,
            'father_name' => $this->person->father_name,
            'mother_name' => $this->person->mother_name,
            'baptism_date' => $this->person->baptism_date,
            'church_from' => $this->person->church_from,
            'affiliation_date' => $this->person->affiliation_date,
            'receipt_date' => $this->person->receipt_date,
            'picture' => $this->person->picture,
        ]);
    }

    protected function getPersonFormSchema(): array
    {
        $form = [
            Components\Card::make([
                Components\FileUpload::make('picture')
                    ->label('Foto')
                    ->image()
                    ->getUploadedFileUrlUsing(fn ($file) => tenant_asset($file))
                    ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file) {
                        return str($file->generateHashNameWithOriginalNameEmbedded($file))
                            ->prepend('people/' . now()->format('Y-m-d') . '/');
                    })
                    ->columnSpan(2),
                // ->getUploadedFileNameForStorageUsing(
                //     function (TemporaryUploadedFile $file, $get): string {
                //         $fileName = 'picture-' . str($get('name'))->slug();

                //         $finalFileName = str($fileName)
                //             ->prepend('people/')
                //             ->append('.' . $file->getClientOriginalExtension());

                //         return $finalFileName;
                //     }
                // ),
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
                ])->columns(3),
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
                        ->columnSpan(2)
                        ->defaultItems(0)
                ])
                    ->columns(2)
                    ->columnSpan(2)
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
                        ->columns(3)
                        ->columnSpan(2)
                        ->defaultItems(0)
                ])
                    ->columns(2)
                    ->columnSpan(2)
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
                        ->columns(2)
                        ->columnSpan(2)
                        ->defaultItems(0)
                ])
                    ->columns(2)
                    ->columnSpan(2)
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
                            Components\FileUpload::make('copy_picture')
                                ->label('Anexar cópia')
                                ->columnSpan(2)
                                ->getUploadedFileUrlUsing(fn ($file) => tenant_asset($file))
                        ])
                        ->columns(2)
                        ->columnSpan(2)
                        ->defaultItems(0)
                ])
                    ->columns(2)
                    ->columnSpan(2)
                    ->label('Documentos')
            ])
                ->columns(2)

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

        // $this->user->fill($userForm);

        // $this->user->person->fill([
        //     'name' => $this->user->name,
        //     ...$personForm
        // ]);

        // $this->user->push();
        $this->person->fill($personForm)->save();

        Notification::make()
            ->title('Informações do membro atualizadas com sucesso!')
            ->success()
            ->send();

        return redirect()->route('people.index');
    }

    public function render(): View
    {
        return view('livewire.tenant.people.edit')
            ->layout('tenant.layouts.dashboard-layout');
    }
}
