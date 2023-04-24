<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modality extends BaseModel
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];


    public function instructors() {
        // return $this->belongsToMany(Modality::class, 'instructor_modalities')->withPivot(['id', 'remuneration_type', 'remuneration_value', 'calc_on_absense', 'enabled']);

        return $this->belongsToMany(Instructor::class, 'instructor_modalities', 'id', 'instructor_id');
    }
}
