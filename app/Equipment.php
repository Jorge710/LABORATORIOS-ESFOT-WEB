<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $table ="equipment";
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'code',
        'systems_id',
        'name',
        'description', 
        'function', 
        'recommendation', 
        'maintenance', 
        'image_equipment', 
        'datasheet', 
        'handbook', 
        'borrowed',
        'in_maintenance',
        'maintenance_frequency_id'
    ];
    protected $guarded =[];

    /**El Elocuente es un ORM (Objeto Modelo Relacional)
     * utilizado para el mapeo de las entidades.
     */
    public function system(){
        return $this->belongsTo(SystemsEquipment::class);
    }
    
    public function criticality(){
        return $this->hasOne(Classifications::class);
    }

    public function elements(){
        return $this->hasMany(Elements::class);
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function equipmentsLoaned(){
        return $this->hasMany(Equipment_loan::class);
    }

    public function maintenanceFrequency(){
        return $this->belongsTo(MaintenanceFrequency::class);
    }
}
