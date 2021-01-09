<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Areas extends Model
{
    protected $table ="areas";
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = ['code','locations_id','name','description', 'image_areas'];
    protected $guarded =[];

    /**El Elocuente es un ORM (Objeto Modelo Relacional)
     * utilizado para el mapeo de las entidades.
     */
    public function location(){
        return $this->belongsTo(Locations::class);
    }

    public function systems(){
        return $this->hasMany(SystemsEquipment::class);
    }
}
