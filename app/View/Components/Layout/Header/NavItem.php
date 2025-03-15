<?php

namespace App\View\Components\Layout\Header;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NavItem extends Component
{
    public $url;
    public $label;
    public $icon;
    public $mobile;
    public $navigate;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $url = '#',
        $label = '',
        $icon = null,
        $mobile = false,
        $navigate = false
    ) {
        $this->url = $url;
        $this->label = $label;
        $this->icon = $icon;
        $this->mobile = $mobile;
        $this->navigate = $navigate;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layout.header.nav-item');
    }
}
