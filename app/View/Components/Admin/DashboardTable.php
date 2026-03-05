<?php

namespace App\View\Components\admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DashboardTable extends Component
{
    public $list;
    public $routeLink;

    /**
     * Create a new component instance.
     */
    public function __construct($list, $routeLink = null)
    {
        //
        $this->list = $list;
        $this->routeLink = $routeLink;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.dashboard-table');
    }
}
