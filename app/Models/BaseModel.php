<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model {


    private $status = [
        1 => 'Ativo',
        0 => 'Inativo'
    ];

    public function getStatusAttribute() {
        return $this->status[$this->enabled];
    }


}