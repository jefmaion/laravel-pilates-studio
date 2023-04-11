<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AbsenseRequest extends FormRequest
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
            'absense_type' => 'required',
            'comments' => 'required_if:absense_type,2',


            'date'          => 'required_with:has_replacement',
            'time'          => 'required_with:has_replacement',
            'instructor_id' => 'required_with:has_replacement',
        ];
    }


}
