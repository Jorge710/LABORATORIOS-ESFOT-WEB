<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionCriticalities extends FormRequest
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
            'frequency' => 'required',
            'operationalImpact' => 'required',
            'flexibility' => 'required',
            'maintenanceCost' => 'required',
            'impactToSafety' => 'required',
            'consequences' => 'required|numeric',
            'total' => 'required|numeric',
            'availabilities_id' => 'required', 
            'maintenance_model_id' => 'required', 
        ];
    }

    public function messages()
    {
        return [
            'frequency.required' => 'El campo frecuencia es requerido.',
            'operationalImpact.required' => 'El campo impacto operacional es requerido.',
            'flexibility.required' => 'El campo flexibilidad es requerido.',
            'maintenanceCost.required' => 'El campo costo de mantenimiento es requerido.',
            'impactToSafety.required' => 'El campo impacto operacional es requerido.',
            'consequences.required' => 'El campo consecuencia es requerido.',
            'total.required' => 'El campo total es requerido.',
            'consequences.numeric' => 'El campo consecuencia debe ser númerico.',
            'total.numeric' => 'El campo total debe ser númerico.'
        ];
    }
}
