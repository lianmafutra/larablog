<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */


    public $name;
    public $placeholder;
    public $id;



    public function __construct($name, $placeholder = null, $id = null)
    {
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.input');
    }
}
