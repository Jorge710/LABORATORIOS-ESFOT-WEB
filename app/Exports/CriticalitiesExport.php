<?php

namespace App\Exports;

use App\Criticalities;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class CriticalitiesExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $criticalities = DB::table('criticalities')
        ->join('equipment','criticalities.equipment_id','=','equipment.id')
        ->join('systems','equipment.systems_id','=','systems.id')
        ->join('areas', 'areas.id', '=', 'systems.areas_id')
        ->join('locations','areas.locations_id','=','locations.id')
        ->join('locations_user', 'locations_user.locations_id', '=','locations.id')
        ->join('users', 'users.id', 'locations_user.user_id')
        ->join('availabilities','availabilities.id','=','criticalities.availabilities_id')
        ->join('maintenance_model','maintenance_model.id','=','criticalities.maintenance_model_id')
        ->select(
            'criticalities.id',
            'locations.code as locations_id',
            'areas.code as areas_id',
            'systems.code as sist_id',
            'equipment.code as equipment_id',
            'equipment.name',
            'criticalities.frequency',
            'criticalities.operationalImpact',
            'criticalities.flexibility',
            'criticalities.maintenanceCost',
            'criticalities.impactToSafety',
            'criticalities.consequences',
            'criticalities.total',
            'availabilities.name as crit_availabilities',
            'maintenance_model.name as crit_maintenance_model'
                )
            ->where('locations_user.user_id', '=', auth()->id())
            ->orderBy('equipment.name','asc')
            ->get();
            return view('criticidades.excel_exports',compact('criticalities'));
    }
}
