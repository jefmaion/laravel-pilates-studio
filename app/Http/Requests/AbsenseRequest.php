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
            'absense_comments' => 'required_if:absense_type,2',
        ];
    }

    public function messages()
    {
        return [
            'absense_type.required'        => 'Selecione o tipo da falta',
            'absense_comments.required_if' => 'Descreva o motivo da falta',
        ];
    }


}
