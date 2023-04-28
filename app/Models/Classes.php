<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];
    
    protected $statusClass = ['Agendada', 'Presença', 'Falta com Aviso', 'Falta', 'Cancelada'];
    protected $statusClassLabel = ['primary', 'success', 'warning', 'danger', 'dark'];
    protected $weekname    = ['Domingo', 'Segunda-Feira', 'Terça-Feira', 'Quarta-Feira', 'Quinta-Feira', 'Sexta-Feira', 'Sábado'];
    protected $classType   = ['AN' => 'Aula Normal', 'RP' => 'Reposição', 'FJ' => 'Falta Com Aviso', 'FF' => 'Falta'];


    public function getClassStatusAttribute() {
        return $this->statusClass[$this->status];
    }

    public function getClassStatusBadgeAttribute() {
        return sprintf('<span class="badge badge-%s badge-shadow"><i class="fas fa-check"></i> %s</span>', $this->classStatusColor, $this->classStatus);
    }

    public function getClassStatusColorAttribute() {
        return $this->statusClassLabel[$this->status];
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

    public function remunerations() {
        return $this->hasMany(InstructorRemuneration::class);
    }

    public function getLastClassAttribute() {
        return $this->where('status', 1)->where('finished', 1)->where('student_id', $this->student_id)->orderBy('date', 'desc')->first();
    }

    public function hasReplacement() {
        return $this->where('classes_id', $this->id)->first();
    }

    public function getExercicesIdsAttribute() {
        $data = $this->exercices->toArray();

        $ids = array_map(function($item){
            return $item['pivot']['exercice_id'];
        }, $data);

        return $ids;
    }

    public function getPendenciesAttribute() {

        $pendencies = [];

        if($this->status == 1 && empty($this->evolution)) {
            $pendencies[] = 'Evolução não registrada';
        }

        if($this->status == 2 && is_null($this->hasReplacement())) {
            $pendencies[] = 'Reposição não agendada';
        }

        
        return $pendencies;
    }

}
