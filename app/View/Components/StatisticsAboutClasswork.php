<?php

namespace App\View\Components;

use App\Models\Classwork;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class StatisticsAboutClasswork extends Component
{
    /**
     * Create a new component instance.
     */
    public Classwork $classwork;
    public bool $teacher;
    public function __construct($id)
    {
        $this->classwork=Classwork::find($id);
        
        $this->teacher=DB::table("classrooms_users")
        ->where("user_id","=",Auth::id())
        ->where('classroom_id',"=",$this->classwork->classroom_id)
        ->where("role","=","teacher")
        ->exists();

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.statistics-about-classwork');
    }
}
