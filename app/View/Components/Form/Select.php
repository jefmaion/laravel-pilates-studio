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


    private function prepareData($data, $value=null) {

        $return = [];

        $value = (!is_array($value)) ? [$value] : $value;

        $value = array_map(function($item){
            return (string) $item;
        }, $value);



        foreach($data as $val => $label) {

            if(is_array($label)) {
                $item = array_values($label);
                $val = $item[0];
                $label = $item[1];

            }
            
            $selected = null;

            foreach($value as $v) {
                if( (string) $v === (string) $val ) {
                    $selected = 'selected';
                    break;
                }
            }

            // $selected = ((string) $value === (string) $val) ? 'selected' : null;

            $return[$val] = [
                'value' => $val,
                'label' => $label,
                'selected' =>$selected
            ];

        }
        return $return;
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
