<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Role_user extends Pivot
{
    protected $table ="role_user";
    protected $fillable = ['role_id','user_id','state'];
    public $state;
}
