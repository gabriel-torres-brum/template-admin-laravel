<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DrawerMenuDropdownLink extends Component
{
    public string $label;
    public string $route;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $route)
    {
        $this->label = $label;
        $this->route = $route;
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.drawer-menu-dropdown-link');
    }
}
