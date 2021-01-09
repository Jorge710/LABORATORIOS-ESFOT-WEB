<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionHome extends FormRequest
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
            'mission' => 'nullable|string',
            'vision' => 'nullable|string',
            'sliderImage1' => 'nullable|image|max:2048', 
            'sliderImage2' => 'nullable|image|max:2048',  
            'sliderImage3' => 'nullable|image|max:2048',  
            'image1' => 'nullable|image|max:2048',  
            'image2' => 'nullable|image|max:2048', 
            'image3' => 'nullable|image|max:2048', 
            'image4' => 'nullable|image|max:2048', 
            'image5' => 'nullable|image|max:2048', 
            'image6' => 'nullable|image|max:2048', 
            'email' => ['nullable', 'string', 'email']
        ];
    }

    public function messages()
    {
        return [
            'sliderImage1.max' => 'La imagen del slider 1 no puede tener un peso mayor a 2MB.',
            'sliderImage1.image' => 'La imagen del slider 1 debe de ser en formato jpeg, png, jpg',
            'sliderImage2.max' => 'La imagen del slider 2 no puede tener un peso mayor a 2MB.',
            'sliderImage2.image' => 'La imagen del slider 2 debe de ser en formato jpeg, png, jpg',
            'sliderImage3.max' => 'La imagen del slider 3 no puede tener un peso mayor a 2MB.',
            'sliderImage3.image' => 'La imagen del slider 3 debe de ser en formato jpeg, png, jpg',
            'image1.max' => 'La imagen de la galería 1 no puede tener un peso mayor a 2MB.',
            'image1.image' => 'La imagen de la galería 1 debe de ser en formato jpeg, png, jpg',
            'image2.max' => 'La imagen de la galería 2 no puede tener un peso mayor a 2MB.',
            'image2.image' => 'La imagen de la galería 2 debe de ser en formato jpeg, png, jpg',
            'image3.max' => 'La imagen de la galería 3 no puede tener un peso mayor a 2MB.',
            'image3.image' => 'La imagen de la galería 3 debe de ser en formato jpeg, png, jpg',
            'image4.max' => 'La imagen de la galería 4 no puede tener un peso mayor a 2MB.',
            'image4.image' => 'La imagen de la galería 4 debe de ser en formato jpeg, png, jpg',
            'image5.max' => 'La imagen de la galería 5 no puede tener un peso mayor a 2MB.',
            'image5.image' => 'La imagen de la galería 5 debe de ser en formato jpeg, png, jpg',
            'image6.max' => 'La imagen de la galería 6 no puede tener un peso mayor a 2MB.',
            'image6.image' => 'La imagen de la galería 6 debe de ser en formato jpeg, png, jpg',
        ];
    }
}
