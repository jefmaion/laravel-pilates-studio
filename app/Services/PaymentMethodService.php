<?php 

namespace App\Services;

use App\Models\PaymentMethod;


class PaymentMethodService extends Service {

    public function __construct(PaymentMethod $paymentMethod)
    {
        parent::__construct($paymentMethod);
    }

    
    public function listCombo() {
        return PaymentMethod::select(['id', 'name'])->get()->toArray();
    }

    public function listToDataTable() {

        $response = [];
        $data = $this->latest();

        foreach($data as $item) {
            $response[] = [
                'id' => $item->id,
                'name' => sprintf('<a href="%s">%s</a>', route('modality.show', $item), $item->name),
                'status' => $item->status,
                'created_at' => $item->created_at->format('d/m/Y')
            ];
        }

        return json_encode(['data' => $response]);
    }

}
