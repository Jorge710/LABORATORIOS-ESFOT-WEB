<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Criticalities extends Model
{
    protected $table ="criticalities";
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id' => 'incrementing',
        'equipment_id', 
        'frequency', 
        'operationalImpact', 
        'flexibility', 
        'maintenanceCost', 
        'impactToSafety', 
        'consequences', 
        'total', 
        'availabilities_id', 
        'maintenance_model_id'
    ];

    protected $guarded =[];

    /**El Elocuente es un ORM (Objeto Modelo Relacional)
     * utilizado para el mapeo de las entidades.
     */
}
