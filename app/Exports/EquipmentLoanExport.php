<?php

namespace App\Exports;

use App\Equipment_loan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Carbon\Carbon;

class EquipmentLoanExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        /* $date = Carbon::now();

        $equipos = DB::table('equipos_prestamos as ep')
        ->leftJoin('equipos', 'ep.equipos_id', '=', 'equipos.id')
        ->leftJoin('users', 'ep.user_id', '=', 'users.id')
        ->leftJoin('localizaciones_user', 'localizaciones_user.user_id', '=', 'users.id')
        ->leftJoin('localizaciones', 'localizaciones_user.localizaciones_id', '=', 'localizaciones.id')
        ->select(
            'equipos.id as equi_id',
            'equipos.codigo as equi_codigo',
            'equipos.nombre as equi_nombre',
            'equipos.imagen as equi_imagen',
            'users.name as user_nombre_prestado_por',
            'users.lastname as user_apellido_prestado_por',
            'ep.nombre as user_prestado_a',
            'ep.email as email',
            'ep.facultad as facultad',
            'ep.carrera as carrera',
            'ep.fecha_prestamo as fecha_prestamo',
            'ep.fecha_devolucion as fecha_devolucion',
            'ep.observacion_prestamo as observacion_prestamo',
            'ep.observacion_entrega as observacion_entrega'
        )
        ->where('fecha_devolucion', '>=', $constraints['from'])
        ->where('fecha_devolucion', '<=', $constraints['to'])
        ->get();

        return view('equipos_prestamos.excel_exports',compact('equipos')); */
    }
}
