<?php

namespace App\Exports;

use App\Systems;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class SystemsExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $systems = DB::table('systems')
        ->join('areas', 'systems.areas_id', '=', 'areas.id')
        ->join('locations', 'areas.locations_id', '=', 'locations.id')
        ->join('locations_user', 'locations_user.locations_id', '=','locations.id')
        ->join('users', 'users.id', 'locations_user.user_id')
        ->select(
            'systems.id as id',
            'systems.code as code',
            'systems.name as name',
            'areas.code as code_area',
            'locations.code as code_locations'
            )
        ->where('locations_user.user_id', '=', auth()->id())
        ->get();
        return view('sistemas.excel_exports',compact('systems'));
    }
}
