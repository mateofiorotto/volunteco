<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HostsList extends Component
{
    public $hosts;

    /**
     * Create a new component instance.
     */
    public function __construct($hosts)
    {
        //
        $this->hosts = $hosts;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.hosts-list');
    }
}
