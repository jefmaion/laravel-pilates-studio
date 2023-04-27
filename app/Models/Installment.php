<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];


    public function registration() {
        return $this->belongsTo(Registration::class);
    }

    public function paymentMethod() {
        return $this->belongsTo(PaymentMethod::class);
    }


    public function getStatusLabelAttribute() {
        $badge = '<span class="badge badge-pill badge-%s"><span></span> %s</span>';

        $dueDate = date('d/m/Y', strtotime($this->date));

        if($this->status == 1) {
            return sprintf($badge, 'success',  'Pago');
        }

        if($this->date == date('Y-m-d')) {
            return sprintf($badge, 'warning',  'Pagar Hoje');
        }

        if($this->date > date('Y-m-d') && $this->status == 0) {
            return sprintf($badge, 'light',  'Aberto');
        }

        if($this->date < date('Y-m-d') && $this->status == 0) {
            return sprintf($badge,   'danger',  'Atrasada');
        }

    }
}
