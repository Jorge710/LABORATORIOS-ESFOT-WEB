<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeFailures extends Model
{
    protected $table ="type_failures";
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = ['id','name'];
    protected $guarded =[];

    /**El Elocuente es un ORM (Objeto Modelo Relacional)
     * utilizado para el mapeo de las entidades.
     */
    public function element(){
        return $this->hasOne(Elements::class);
    }
}
