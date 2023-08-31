<?php

namespace App\View\Components;

use App\Models\Classwork;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatisticsAboutClasswork extends Component
{
    /**
     * Create a new component instance.
     */
    public Classwork $classwork;
    public function __construct($id)
    {
        $this->classwork=Classwork::find($id);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.statistics-about-classwork');
    }
}
