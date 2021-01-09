<?php

namespace App\Exports;

use App\Equipment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class EquipmentExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $equipment = DB::table('equipment')
        ->join('systems', 'systems.id', '=', 'equipment.systems_id')
        ->join('areas', 'areas.id', '=', 'systems.areas_id')
        ->join('locations', 'locations.id', '=', 'areas.locations_id')
        ->join('locations_user', 'locations_user.locations_id', '=','locations.id')
        ->join('users', 'users.id', 'locations_user.user_id')
            ->select(
                'locations.code as locations_code',
                'areas.code as area_code',
                'systems.code as systems_code',
                'equipment.code as code',
                'equipment.name as name',
                'equipment.description as description',
                'equipment.assign_criticality as assign_criticality'
                )
        ->where('locations_user.user_id', '=', auth()->id())
        ->get();
        return view('equipos.excel_exports',compact('equipment'));
    }
}
