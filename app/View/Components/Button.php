<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    /**
     * Create a new component instance.
     * fungsi construct digunakan untuk passing data
     *
     * @return void
     */

    //data yang akan kita passing
    public $color;
    public $title;



    public function __construct($color = 'info', $title)
    {
        $this->color = $color;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     * 
     * @return \Illuminate\View\View|string
     */
    public function render()
    {

        return view('components.button');
    }
}
