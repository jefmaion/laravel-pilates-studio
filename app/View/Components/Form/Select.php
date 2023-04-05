<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Select extends Component
{

    public $options;
    public $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($options=[], $value=null)
    {

        

        $this->options = $this->prepareData($options, $value);

    }


    private function prepareData($data, $value) {

        foreach($data as $val => $label) {

            $selected = ((string) $value === (string) $val) ? 'selected' : null;

            $data[$val] = [
                'value' => $val,
                'label' => $label,
                'selected' =>$selected
            ];

        }

        return $data;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.select');
    }
}
