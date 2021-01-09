<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Locations extends Model
{
    protected $table ="locations";
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['code','name','description','telephone','ext', 'image_locations'];
    protected $guarded =[];

    /**El Elocuente es un ORM (Objeto Modelo Relacional)
     * utilizado para el mapeo de las entidades.
     */
    public function users(): BelongsToMany{
        return $this->belongsToMany(User::class);
    }

    public function areas(){
        return $this->hasMany(Areas::class);
    }
}
