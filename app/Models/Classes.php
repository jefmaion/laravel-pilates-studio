<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];
    
    protected $statusClass = ['Agendada', 'Presença', 'Falta com Aviso', 'Falta', 'Cancelada'];

    protected $weekname    = ['Domingo', 'Segunda-Feira', 'Terça-Feira', 'Quarta-Feira', 'Quinta-Feira', 'Sexta-Feira', 'Sábado'];

    protected $classType = ['AN' => 'Aula Normal', 'RP' => 'Reposição', 'FJ' => 'Falta Com Aviso', 'FF' => 'Falta'];


    public function getClassStatusAttribute() {
        return $this->statusClass[$this->status];
    }

    public function getClassTypeAttribute() {
        return $this->classType[$this->type];
    }

    public function getWeeknameAttribute() {
        return $this->weekname[$this->weekday];
    }

    public function parent() {
        return $this->belongsTo(Classes::class, 'classes_id', 'id');
    }

    public function student() {
        return $this->belongsTo(Student::class);
    }

    public function instructor() {
        return $this->belongsTo(Instructor::class);
    }

    public function registration() {
        return $this->belongsTo(Registration::class);
    }

    public function exercices() {
        return $this->belongsToMany(Exercice::class, 'class_exercices')->using(ClassExercice::class);
    }

    public function getLastClassAttribute() {
        return $this->where('status', 1)->where('finished', 1)->where('student_id', $this->student_id)->orderBy('date', 'desc')->first();
    }

}
