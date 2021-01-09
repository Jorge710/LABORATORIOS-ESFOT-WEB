<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaintenanceFrequency extends Model
{
    protected $table ="maintenance_frequency";
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = ['id','name'];
    protected $guarded =[];

    /**El Elocuente es un ORM (Objeto Modelo Relacional)
     * utilizado para el mapeo de las entidades.
     */
    public function equipments(){
        return $this->hasMany(Equipment::class);
    }
}
