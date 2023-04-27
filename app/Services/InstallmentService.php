<?php

namespace App\Services;


use App\Models\Installment;

class InstallmentService extends Service
{

    public function __construct(Installment $installment)
    {
        parent::__construct($installment);
    }

    public function listToDataTable() {
        $response = [];
        $data     = $this->latest();

        foreach($data as $item) {
            $response[] = [
                'id'         => $item->id,
                'date'       => formatData($item->date),
                'name'       => sprintf('<a href="%s">%s</a>', route('installment.show', $item), $item->registration->student->user->name),
                'modality' => $item->registration->modality->name,
                'value' => currency($item->value),

                'status' => $item->statusLabel,
                'created_at' => $item->created_at->format('d/m/Y')
            ];
        }

        return json_encode(['data' => $response]);
    }
}