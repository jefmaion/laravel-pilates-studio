<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreInstructorModalityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {


        return [
            'modality_id' => [
                'required',
                Rule::unique('instructor_modalities')->where(function($query){
                    $query->where('instructor_id', $this->instructor_id)->where('modality_id', $this->modality_id);
                })
            ],
            'remuneration_type' => 'required',
            'remuneration_value' => 'required',
        ];
    }
}
