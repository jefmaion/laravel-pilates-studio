<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Avatar extends Component
{

    public $size;
    public $src;
    public $second;
    public $status;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($size='', $second='', $src='', $status='')
    {
        $this->size = $size;
        $this->src = $src;
        $this->second = $second;
        $this->status = $status;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.avatar');
    }
}
