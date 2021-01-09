<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionEquipment extends FormRequest
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
            'systems_id' => 'required',
            'code' => 'required|unique:equipment,code,' . $this->route('id'),
            'name' => 'required',
            'description' => 'required',
            'function' => 'required', 
            'recommendation' => 'required',
            'maintenance' => 'required',
            'image_equipment' => 'image|max:2048',
            'datasheet' => 'max:2048|mimes:pdf',
            'handbook' => 'max:2048|mimes:pdf',
            'maintenance_frequency_id' => 'required'
        ];
        
    }

    public function messages()
    {
        return [
            'code.unique' => 'Ya existe este código registrado.',
            'name.required' => 'El campo nombre es requerido.',
            'description.required' => 'El campo descripción es requerido.',
            'function.required' => 'El campo función es requerido.',
            'recommendation.required' => 'El campo recomendación es requerido.',
            'maintenance.required' => 'El campo mantenimiento es requerido.',
            'image_equipment.max' => 'La imagen no puede tener un peso mayor a 2MB.',
            'image_equipment.image' => 'La imagen debe de ser en formato jpeg, png, jpg',
            'datasheet.mimes' => 'La ficha técnica debe de ser en formato .pdf',
            'handbook.mimes' => 'El manual debe de ser en formato .pdf'
        ];
    }
}
