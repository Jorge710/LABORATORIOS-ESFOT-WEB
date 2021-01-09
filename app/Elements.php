<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Elements extends Model
{
    protected $table ="elements";
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'equipment_id',
        'name',
        'number_of',
        'description',
        'function',
        'image_elements',
        'faultDescription',
        'typefailures_id',
        'failMode',
        'classifications_id',
        'maintenanceActivity',
        'maintenanceTask',
        'improvements'
    ];

    protected $guarded =[];

    /**El Elocuente es un ORM (Objeto Modelo Relacional)
     * utilizado para el mapeo de las entidades.
     */
    public function equipment(){
        return $this->belongsTo(Equipment::class);
    }
}
