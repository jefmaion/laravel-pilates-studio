<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function getEvolutionsAttribute() {
        return $this->classes()->whereNotNull('evolution')->orderBy('date', 'desc')->get();
    }

    public function countClasses($type=null) {
        if(!$type) {
            return $this->classes()->where('type', 'AN')->count();
        }

        if($type === 'presences') {
            return $this->classes()->where('status', 1)->count();
        }

        if($type === 'absenses') {
            return $this->classes()->whereIn('status', [2,3])->count();
        }

        if($type === 'remarks') {
            return $this->classes()->where('type', 'RP')->count();
        }
    }

    public function getCountClassesAttribute() {
        return $this->classes()->where('type', 'AN')->count();
    }

    public function getCountPresencesAttribute() {
        return $this->classes()->where('status', 1)->count();
    }

    public function getCountAbsenseAttribute() {
        return $this->classes()->where('status', 1)->count();
    }

    public function getRenewAttribute() {

        $days = Carbon::now()->diffInDays($this->end, false);

        if($days == 0) {
            return '<span class="badge badge-pill badge-warning badge-shadow">Renovar hoje</span>';
        }

        if($days < 0) {
            return '<span class="badge badge-pill badge-danger badge-shadow">Renovação Atrasada</span>';
        }

        if($days <= 5) {
            return '<span class="badge badge-pill badge-warning badge-shadow">Renovar em '. $days . ' dias</span>';
        }
        

        
    }
}
