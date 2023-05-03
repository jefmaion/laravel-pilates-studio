<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends BaseModel
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];
    

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function registration() {
        return $this->hasMany(Registration::class);
    }

    public function classes() {
        return $this->hasMany(Classes::class)->with(['instructor.user', 'registration.modality']);
    }

    public function installments() {
        return $this->hasMany(AccountReceivable::class)->with(['registration.modality']);
    }

    public function evolutions() {
        return $this->hasMany(Classes::class)->with(['instructor', 'exercices'])->where('finished', 1)->whereNotNull('evolution')->orderBy('date','desc');
    }

    public function lastEvolutions() {
        return $this->evolutions()->limit(3);
    }

    public function countReplacement($month=null) {
        return (2 - $this->hasMany(Classes::class)->whereMonth('date', ($month ?? date('n')))->where('type', 'RP')->count());
    }
}
