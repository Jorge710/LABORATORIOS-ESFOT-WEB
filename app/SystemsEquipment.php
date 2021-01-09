<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SystemsEquipment extends Model
{
    protected $table ="systems";
    public $timestamps = false;
    protected $fillable = ['code', 'areas_id', 'name'];

    /**El Elocuente es un ORM (Objeto Modelo Relacional)
     * utilizado para el mapeo de las entidades.
     */
    public function area(){
        return $this->belongsTo(Areas::class);
    }

    public function eqipments(){
        return $this->hasMany(SystemsEquipment::class);
    }
}
