<?php

namespace App\View\Components\System;

use Illuminate\View\Component;

class AuthLayout extends Component
{
    public string $formActionRoute;
    public ?string $head;
    public ?string $foot;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($formActionRoute, $head = null, $foot = null)
    {
        $this->formActionRoute = $formActionRoute;
        $this->head = $head;
        $this->foot = $foot;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('system.layouts.auth-layout');
    }
}
