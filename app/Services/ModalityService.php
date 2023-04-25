<?php 

namespace App\Services;

use App\Models\Modality;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ModalityService extends Service {

    public function __construct(Modality $modality)
    {
        parent::__construct($modality);
    }

    public function delete(Model $modality) {

        if($modality->instructors()->count() > 0) {
            $this->setErrorMessage('Não é possível excluir a modalidade '.$modality->name.'. Existem professores atrelados a essa modalidade');
            return false;
        }

        return $modality->delete();

    }

    public function listCombo() {
        return Modality::select(['id', 'name'])->get()->toArray();
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
