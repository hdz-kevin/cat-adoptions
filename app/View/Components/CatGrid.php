<?php

namespace App\View\Components;

use App\Models\Cat;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CatGrid extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Cat $cat
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cat-grid');
    }
}
