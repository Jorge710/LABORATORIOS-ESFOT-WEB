<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UpdatePage extends Model
{
    protected $table ="update_page";
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = 
        [
            'mission',
            'vision',
            'sliderImage1', 
            'sliderImage2', 
            'sliderImage3', 
            'image1', 
            'image2', 
            'image3', 
            'image4', 
            'image5', 
            'image6', 
            'email'
        ];
    protected $guarded =[];
}
