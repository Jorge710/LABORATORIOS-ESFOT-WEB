<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionAvatar extends FormRequest
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
            'avatar' => 'nullable|image|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'avatar.max' => 'La imagen no puede tener un peso mayor a 2MB.',
            'avatar.image' => 'La imagen debe de ser en formato jpeg, png, jpg.'
        ];
    }
}
