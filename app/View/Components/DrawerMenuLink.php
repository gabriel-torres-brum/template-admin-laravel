<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Str;

class DrawerMenuLink extends Component
{
    public string $label;
    public string $dropdownId;
    public ?string $route;
    public ?string $icon;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $route = null, $icon = null)
    {
        $this->label = $label;
        $this->dropdownId = Str::slug($label, "_");
        $this->route = $route;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.drawer-menu-link');
    }
}
