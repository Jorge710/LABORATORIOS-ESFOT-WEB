<?php

namespace App;

use Caffeinated\Shinobi\Concerns\HasRolesAndPermissions;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    //use Notifiable;
    /**SE DEBE DE IMPORTAR LOS DOS PAQUETES DE SHINOBI PARA LARAVEL 6 */
    use Notifiable, HasRolesAndPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','ci','name', 'lastname', 'email', 'password', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**FUNCIONES */
    public function scopeFindBy($query, $tipo, $buscar){
        if(($tipo) && ($buscar)){
            return $query->where($tipo, 'like', "%buscar%");
        }
    }

    public function getRelationRoleUser(){
        return $this->roles()->get();
    }

    /**Eloquent ORM (Objeto Modelo Relacional)
     * utilizado para el mapeo de las entidades.
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(config('shinobi.models.role'))->withPivot(['state'])->withTimestamps();
    }

    public function locations(): BelongsToMany{
        return $this->belongsToMany(Locations::class)->withTimestamps();
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }
}
