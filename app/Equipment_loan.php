<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment_loan extends Model
{
    protected $table ="equipment_loaned";
    protected $fillable = ['lent_by', 'equipment_id','name','faculty','career','email' , 'loan_observation', 'observation_return', 'loan_date','return_date', 'received_by'];
    public $timestamps = false;

    /**El Elocuente es un ORM (Objeto Modelo Relacional)
     * utilizado para el mapeo de las entidades.
     */
    public function equipment(){
        return $this->belongsTo(Equipment::class);
    }
}
