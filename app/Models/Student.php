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
        return $this->hasMany(Classes::class)->where('finished', 1);
    }

    public function installments() {
        return $this->hasMany(Transaction::class);
    }

    public function evolutions() {
        return $this->classes()->orderBy('date','desc')->whereNotNull('evolution');
    }

    public function lastEvolutions() {
        return $this->evolutions()->limit(3);
    }

    public function countReplacement($month=null) {
        return (2 - $this->hasMany(Classes::class)->whereMonth('date', ($month ?? date('n')))->where('type', 'RP')->count());
    }
}
