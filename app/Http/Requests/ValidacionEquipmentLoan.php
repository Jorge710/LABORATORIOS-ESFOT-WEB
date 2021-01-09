<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionEquipmentLoan extends FormRequest
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
            'equipment_id' => 'required',
            'name' => 'required',
            'faculty' => 'required',
            'career' => 'required',
            'email' => 'required|email'            
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo nombre es requerido.',
            'faculty.required' => 'El campo facultad es requerido.',
            'career.required' => 'El campo carrera es requerido.',
            'email.required' => 'El campo email es requerido.',
            'email.email' => 'Debe ser un email correcto.'
        ];
    }
}
