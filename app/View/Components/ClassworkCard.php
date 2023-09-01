<?php

namespace App\View\Components;

use App\Models\Classwork;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ClassworkCard extends Component
{
    /**
     * Create a new component instance.
     */
    public Classwork $classworkItem;
    public function __construct($id)

    {
        $this->classworkItem=Classwork::find($id);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.classwork-card');
    }
}
