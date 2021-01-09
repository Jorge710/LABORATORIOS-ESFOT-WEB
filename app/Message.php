<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = 
    [
        'sender_id',
        'recipient_id',
        'equipment_id',
        'body',
        'maintenance_report',
        'maintenance_date', 
        'commissioned'
    ];
    protected $guarded = ['id'];

    /**El Elocuente es un ORM (Objeto Modelo Relacional)
     * utilizado para el mapeo de las entidades.
     */
    public function equipment(){
        return $this->belongsTo(Equipment::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }    
}
