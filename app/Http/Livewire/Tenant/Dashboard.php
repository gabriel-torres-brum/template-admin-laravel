<?php

namespace App\Http\Livewire\Tenant;

use Livewire\Component;

class Dashboard extends Component
{
    public string $dashboardText;

    public function mount()
    {
        $this->dashboardText = $this->getDayInformation();
    }

    protected function getDayInformation(): string
    {
        return now()->dayName . ", " . now()->day . " de " . now()->monthName . " de " . now()->year . ".";
    }

    public function render()
    {
        return view('livewire.tenant.dashboard');
    }
}
