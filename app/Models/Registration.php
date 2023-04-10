<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $dates = ['start', 'end'];

    protected $durationName = [
        1 => 'Mensal',
        2 => 'Bimestral',
        3 => 'Trimestral'
    ];

    protected $statusName = [
        'Cancelado', 'Em Andamento'
    ];


    public function getDurationNameAttribute() {
        return $this->durationName[$this->duration];
    }

    public function getStatusNameAttribute() {
        return $this->statusName[$this->status];
    }


    public function student() {
        return $this->belongsTo(Student::class);
    }

    public function modality() {
        return $this->belongsTo(Modality::class);
    }

    public function classes() {
        return $this->hasMany(Classes::class)->orderBy('date', 'asc');
    }

    public function weekClass() {
        return $this->hasMany(RegistrationClass::class);
    }
}
