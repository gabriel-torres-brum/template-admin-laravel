<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public string $dashboardText;

    public function mount()
    {
        $date = new \DateTime();
        $formatter = new \IntlDateFormatter(
            'pt_BR',
            \IntlDateFormatter::FULL,
            \IntlDateFormatter::NONE,
            'America/Sao_Paulo',          
            \IntlDateFormatter::GREGORIAN
        );

        $this->dashboardText = ucfirst($formatter->format($date)) . ".";
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
