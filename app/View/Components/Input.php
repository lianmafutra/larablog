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

    public $name, $placeholder, $id, $label, $type, $value;

    public function __construct($name, $placeholder = null, $id = null, $label = null, $type = null, $value = null)
    {
        $this->name        = $name;
        $this->placeholder = $placeholder;
        $this->id          = $id;
        $this->label       = $label;
        $this->type        = $type;
        $this->value       = $value;
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
