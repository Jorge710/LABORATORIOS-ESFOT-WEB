<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionLocations extends FormRequest
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
            'code' => 'required|unique:locations,code,' . $this->route('id'),
            'name' => 'required|unique:locations,name,'.$this->route('id'),
            'image_locations' => 'nullable|image|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'code.unique' => 'Ya existe este código registrado.',
            'name.unique' => 'Ya existe un laboratorio con este nombre.',
            'image_locations.max' => 'La imagen no puede tener un peso mayor a 2MB.',
            'image_locations.image' => 'La imagen debe de ser en formato jpeg, png, jpg',
        ];
    }
}
