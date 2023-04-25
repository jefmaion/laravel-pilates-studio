<?php

namespace App\Services;

use App\Models\Exercice;

class ExerciceService extends Service
{

    public function __construct()
    {
        parent::__construct(new Exercice());
    }

    public function listCombo() {
        return Exercice::select(['id', 'name'])->get()->toArray();
    }

    public function listToDataTable() {
        $response = [];
        $data     = $this->latest();

        foreach($data as $item) {
            $response[] = [
                'id'         => $item->id,
                'type'       => $item->type,
                'name'       => sprintf('<a href="%s">%s</a>', route('exercice.show', $item), $item->name),
                'created_at' => $item->created_at->format('d/m/Y')
            ];
        }

        return json_encode(['data' => $response]);
    }
}