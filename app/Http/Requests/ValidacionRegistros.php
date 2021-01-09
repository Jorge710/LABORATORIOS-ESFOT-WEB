<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionRegistros extends FormRequest
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
            'ci' => 'required|numeric',
            'name' => ['required', 'string'],
            'lastname' => ['required', 'string'],
            'email' => ['required', 'string', 'email'],
            'avatar' => 'nullable|image|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo nombre es requerido.',
            'lastname.required' => 'El campo apellido es requerido.',
            'email.required' => 'El campo email es requerido.',
            'email.email' => 'Debe ser un email correcto.',
            'avatar.max' => 'La imagen no puede tener un peso mayor a 2MB.',
            'avatar.image' => 'La imagen debe de ser en formato jpeg, png, jpg.'
        ];
    }
}
