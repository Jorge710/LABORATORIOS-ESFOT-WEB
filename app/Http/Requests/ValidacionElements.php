<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionElements extends FormRequest
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
            'number_of' => 'required|numeric',
            'description' => 'required',
            'function' => 'required', 
            'image_elements' => 'image|max:2048',
            'faultDescription' => 'required',
            'typefailures_id' => 'required',
            'failMode' => 'required',
            'classifications_id' => 'required',
            'maintenanceActivity' => 'required',
            'maintenanceTask' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo nombre es requerido.',
            'number_of.numeric' => 'El campo cantidad debe ser númerico.',
            'description.required' => 'El campo descripción es requerido.',
            'function.required' => 'El campo descripción es requerido.',
            'image_elements.max' => 'La imagen no puede tener un peso mayor a 2MB.',
            'image_elements.image' => 'La imagen debe de ser en formato jpeg, png, jpg.',
            'faultDescription.required' => 'El campo descripción de fallo es requerido.',
            'failMode.required' => 'El campo modo de fallo es requerido.',
            'maintenanceActivity.required' => 'El campo actividad de mantenimiento es requerido.',
            'maintenanceTask.required' => 'El campo tarea de mantenimiento es requerido.'
        ];
    }
}
