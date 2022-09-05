<?php

namespace App\View\Components;

use Illuminate\View\Component;

class HeaderLink extends Component
{
    public string $label;
    public ?string $route;
    public ?string $routeIs;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $label, ?string $route = null, ?string $routeIs = null)
    {
        $this->label = $label;
        $this->route = $route;
        $this->routeIs = $routeIs;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.header-link');
    }
}
