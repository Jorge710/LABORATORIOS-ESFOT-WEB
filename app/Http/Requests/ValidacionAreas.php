<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionAreas extends FormRequest
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
            'code' => 'required|unique:areas,code,' . $this->route('id'),
            'locations_id' => 'required',
            'image_areas' => 'nullable|image|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'code.unique' => 'Ya existe este código registrado.',
            'image_areas.max' => 'La imagen no puede tener un peso mayor a 2MB.',
            'image_areas.image' => 'La imagen debe de ser en formato jpeg, png, jpg',
        ];
    }
}
