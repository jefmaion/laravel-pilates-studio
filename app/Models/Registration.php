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

    public function installments() {
        return $this->hasMany(AccountReceivable::class);
    }

    public function getInstallmentTodayAttribute() {
        return $this->installments()->where('date', date('Y-m-d'))->where('status', 0)->first();
    }

    public function getHasInstallmentLateAttribute() {
        return $this->installments()->where('date', '<', date('Y-m-d'))->where('status', 0)->count();
    }

    public function getEvolutionsAttribute() {
        return $this->classes()->whereNotNull('evolution')->orderBy('date', 'desc')->get();
    }

    public function getDaysToRenewAttribute() {
        return Carbon::now()->diffInDays($this->end, false);
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

        if($type === 'finished') {
            return $this->classes()->where('finished', 1)->count();
        }
    }

    

    public function getStatusNameAttribute() {

        $badge = '<span class="badge badge-pill badge-%s badge-shadow">%s</span>';

        if($this->status == 1) {
            
            if($this->daysToRenew == 0) {
                return sprintf($badge, 'warning', 'Renovar matrícula Hoje');
            }
    
            if($this->daysToRenew > 0 && $this->daysToRenew <= 5) {
                return sprintf($badge, 'warning', 'Renovar matrícula em '. $this->daysToRenew . ' dias');
            }

            if($this->daysToRenew < 0) {
                return sprintf($badge, 'danger', 'Renovação Atrasada');
            }

            return sprintf($badge, 'success', 'Matrícula ' . $this->statusName[$this->status]);
        }
        
    }

    public function getRenewAttribute() {

        if($this->daysToRenew == 0) {
            return '<span class="badge badge-pill badge-warning badge-shadow">Renovar hoje</span>';
        }

        if($this->daysToRenew < 0) {
            return '<span class="badge badge-pill badge-danger badge-shadow">Renovação Atrasada</span>';
        }

        if($this->daysToRenew <= 5) {
            return '<span class="badge badge-pill badge-warning badge-shadow">Renovar em '. $this->daysToRenew . ' dias</span>';
        }
        
    }
}
