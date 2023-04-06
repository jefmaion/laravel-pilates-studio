<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $dates = ['start', 'end'];



    public function student() {
        return $this->belongsTo(Student::class);
    }

    public function modality() {
        return $this->belongsTo(Modality::class);
    }

    public function classes() {
        return $this->hasMany(Classes::class);
    }
}
