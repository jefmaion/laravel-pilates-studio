<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class InstructorModality extends Pivot
{
   
    protected $table = 'instructor_modalities';

    private $calcOnAbsense = [
        1 => 'Sim',
        0 => 'Não'
    ];

    private $remunerationType = [
        'P' => 'Percentual de aula (%) ',  
        'F' => 'Valor Fixo', 
        'S' => 'Sócio (%) '
    ];



    public function getCalcOnAbsenseTextAttribute() {
        return $this->calcOnAbsense[$this->attributes['calc_on_absense']];
    }

    public function getRemunerationTypeTextAttribute() {
        return $this->remunerationType[$this->attributes['remuneration_type']];
    }

    // public function getRemunerationValueAttribute() {
    //     return number_format($this->attributes['remuneration_value'], 2, ',', '.');
    // }


}
