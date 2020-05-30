<?php

namespace App\View\Components;

use Illuminate\View\Component;

class table extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $th;

    public function __construct($th = [])
    {
        $this->th = $th;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.table');
    }
}
