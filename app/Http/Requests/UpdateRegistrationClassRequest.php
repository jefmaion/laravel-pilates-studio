<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRegistrationClassRequest extends FormRequest
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
            // 'student_id' => 'required',
            // 'modality_id' => 'required',
            // 'duration' => 'required',
            // 'start' => 'required',
            // 'class_per_week' => 'required',
            // 'due_day' => 'required',
            // 'value' => 'required',

            // 'first_payment_method_id' => 'required',
            // 'other_payment_method_id' => 'required_unless:duration,1',

            'class' => 'array|min:'.$this->class_per_week.'|max:'.$this->class_per_week,
            'class.*.instructor_id' => 'required_with:class.*.time',
            'class.*.time' => 'required_with:class.*.instructor_id'
        ];
    }

    protected function prepareForValidation()
    {


        $values = [];
        foreach($this->class as $key => $item) {

            //verifica se ta vazio
            if(empty($item['instructor_id']) && empty($item['time'])) {
                continue;
            }

            $values[$key] = $item;
        }

        $this->merge([
            'class' => $values
        ]);
    }
}
