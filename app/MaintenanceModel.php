<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaintenanceModel extends Model
{
    protected $table ="maintenance_model";
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = ['id','name'];
    protected $guarded =[];

    /**El Elocuente es un ORM (Objeto Modelo Relacional)
     * utilizado para el mapeo de las entidades.
     */
    public function cariticality(){
        return $this->hasOne(Criticalities::class);
    }
}
