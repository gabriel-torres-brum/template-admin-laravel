<?php

namespace App\Http\Livewire\Tenant;

use App\Http\Services\ViaCepService;
use App\Models\Tenant;
use App\Models\TenantAddress;
use App\Models\TenantEmail;
use App\Models\TenantPhone;
use Livewire\Component;
use Filament\Forms;
use Filament\Forms\Components;
use Filament\Notifications\Notification;

class Config extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public Tenant $tenant;

    protected function getFormModel(): Tenant
    {
        return $this->tenant;
    }

    public function mount(): void
    {
        $this->tenant = tenant();

        $this->form->fill([
            'name' => $this->tenant->name,
            'cnpj' => $this->tenant->cnpj,
            'logo' => $this->tenant->logo,
            'tenantPhones' => TenantPhone::all(),
            'tenantAddresses' => TenantAddress::all(),
            'tenantEmails' => TenantEmail::all(),
        ]);
    }

    protected function getFormSchema(): array
    {
        $form = [
            Components\Card::make([
                Components\TextInput::make('name')
                    ->label('Nome')
                    ->required(),
                Components\TextInput::make('cnpj')
                    ->label('CNPJ')
                    ->mask(fn (Components\TextInput\Mask $mask) => $mask->pattern('00.000.000/0000-00'))
                    ->required(),
                Components\Card::make([
                    Components\Repeater::make('tenantPhones')
                        ->label('Telefones')
                        ->collapsible()
                        ->createItemButtonLabel('Adicionar telefone')
                        ->schema([
                            Components\TextInput::make('number')
                                ->label('Número')
                                ->extraInputAttributes(['x-mask:dynamic' => "\$input.indexOf('9', 5) === 5 ? '(99) 99999-9999' : '(99) 9999-9999'"])
                                ->required(),
                        ])
                        ->defaultItems(0),
                ]),
                Components\Card::make([
                    Components\Repeater::make('tenantAddresses')
                        ->label('Endereços')
                        ->collapsible()
                        ->createItemButtonLabel('Adicionar endereço')
                        ->schema([
                            Components\TextInput::make('cep')
                                ->label('CEP')
                                ->mask(fn (Components\TextInput\Mask $mask) => $mask->pattern('00000-000'))
                                ->reactive()
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
                        ->defaultItems(0),
                ]),
                Components\Card::make([
                    Components\Repeater::make('tenantEmails')
                        ->label('Emails')
                        ->collapsible()
                        ->createItemButtonLabel('Adicionar email')
                        ->schema([
                            Components\TextInput::make('email')
                                ->label('Email')
                                ->email()
                                ->required(),
                        ])
                        ->defaultItems(0)
                ]),
            ])
        ];

        return $form;
    }

    public function submit(): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $form = $this->form->getState();

        $this->tenant->fill($form)->save();

        foreach($form['tenantAddresses'] as $tenantAddress) {
            if (isset($tenantAddress['id'])) {
                TenantAddress::find($tenantAddress['id'])->update($tenantAddress);
            } else {
                (new TenantAddress)->fill($tenantAddress)->save();
            }
        }

        foreach($form['tenantPhones'] as $tenantPhone) {
            if (isset($tenantPhone['id'])) {
                TenantPhone::find($tenantPhone['id'])->update($tenantPhone);
            } else {
                (new TenantPhone)->fill($tenantPhone)->save();
            }
        }

        foreach($form['tenantEmails'] as $tenantEmail) {
            if (isset($tenantEmail['id'])) {
                TenantEmail::find($tenantEmail['id'])->update($tenantEmail);
            } else {
                (new TenantEmail)->fill($tenantEmail)->save();
            }
        }

        Notification::make()
            ->title('Informações atualizadas com sucesso!')
            ->success()
            ->send();

        return redirect()->route('config');
    }

    public function render()
    {
        return view('livewire.tenant.config')
            ->layout('tenant.layouts.dashboard-layout');
    }
}
