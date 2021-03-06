<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Availabilities extends Model
{
    protected $table ="availabilities";
    protected $primarykey = 'id';
    public $timestamps = false;
    public $incrementing = false;//colocar TRUE en el caso que el campo ID sea auto-increment
    protected $fillable = ['id','name'];
    protected $guarded =[];

    /**El Elocuente es un ORM (Objeto Modelo Relacional)
     * utilizado para el mapeo de las entidades.
     */
    public function cariticality(){
        return $this->hasOne(Criticalities::class);
    }
}
