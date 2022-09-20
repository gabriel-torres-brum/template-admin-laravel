<?php

namespace App\Http\Livewire;

use App\Models\Tenant;
use Livewire\Component;

class Index extends Component
{
    public $tenant;
    public array $tenants;

    public function mount()
    {
        $this->tenant = null;
        $this->tenants = Tenant::all()->toArray();
    }

    public function redirectToTenantDomain()
    {
        if ($this->tenant) {
            tenancy()->initialize($this->tenant);

            redirect(tenantRoute('login.index'));
        }
    }

    public function render()
    {
        return view('livewire.index');
    }
}
