<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MealCard extends Component
{
    public $meals;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($meals)
    {
        $this->meals = $meals;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.meal-card');
    }
}
