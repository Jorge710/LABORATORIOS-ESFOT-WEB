<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    protected $table = "roles";
    public $timestamps = true;

    protected $fillable = ['id','name', 'slug', 'description', 'special'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
        ->using(Role_user::class)
        ->withPivot(['state'])->withTimestamps();
    }

    public function permissions() {
		return $this->belongsToMany(Permission::class);
	}
}
