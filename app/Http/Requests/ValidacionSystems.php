<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Validacionsystems extends FormRequest
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
            'areas_id' => 'required',
            'code' => 'required|unique:systems,code,' . $this->route('id'),
        ];
    }

    public function messages()
    {
        return [
            'code.unique' => 'Ya existe este código registrado.'
        ];
    }
}
