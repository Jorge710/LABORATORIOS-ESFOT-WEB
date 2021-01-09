<?php

namespace App\Http\Controllers;

use App\Role_user;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {  
        $user=User::findOrFail(auth()->id()); 
        
        /**Para el Google Chart de Barras indica el total de los equipos por laboratorio */
        $totalEquiposxLaboratorio_chart = DB::table('equipment as e')
            ->join('systems as s','e.systems_id','=','s.id')
            ->join('areas', 'areas.id', '=', 's.areas_id')
            ->join('locations as l','areas.locations_id','=','l.id')
            ->join('locations_user', 'locations_user.locations_id', '=','l.id')
            ->join('users', 'users.id', 'locations_user.user_id')
            ->select(
                'l.name AS LABORATORIO', 
                DB::raw('count(e.id) AS COUNT_LABORATORIO')
                )
            ->where('locations_user.user_id', '=', auth()->id())
            ->groupBy('LABORATORIO')
            ->get();

        /**Para el Google Chart de Barras indica el total de los equipos prestados por laboratorio */
        $totalEquiposPrestadosxLaboratorio_chart = DB::table('equipment as e')
            ->join('systems as s','e.systems_id','=','s.id')
            ->join('areas', 'areas.id', '=', 's.areas_id')
            ->join('locations as l','areas.locations_id','=','l.id')
            ->join('locations_user', 'locations_user.locations_id', '=','l.id')
            ->join('users', 'users.id', 'locations_user.user_id')
            ->select(
                'l.name AS EQUI_PRESTADO_LABORATORIO', 
                DB::raw('count(e.id) AS COUNT_EQUI_PRESTADO_LABORATORIO')
                )
            ->where('locations_user.user_id', '=', auth()->id())
            ->where('e.borrowed', 'LIKE', 'SI')
            ->groupBy('EQUI_PRESTADO_LABORATORIO')
            ->get();

            /**Indica el total usuarios registrados en el sistema */
            $users_number = User::count();
            $locations_Select = DB::table('locations')
            ->join('locations_user', 'locations_user.locations_id', '=','locations.id')
            ->join('users', 'users.id', 'locations_user.user_id')
            ->select(
                'locations.*'
                )
            ->where('locations_user.user_id', '=', auth()->id())
            ->get();
            $locations_number = $locations_Select->count();

            /**Indica el total de areas registradas en el sistema */
            $areas_Select = DB::table('areas')
            ->join('locations', 'areas.locations_id', '=', 'locations.id')
            ->join('locations_user', 'locations_user.locations_id', '=','locations.id')
            ->join('users', 'users.id', 'locations_user.user_id')
            ->select(
                'areas.*'
                )
            ->where('locations_user.user_id', '=', auth()->id())
            ->get();
            $areas_number = $areas_Select->count();

            /**Indica el total de los usuarios registrados pero en estado Inactivos */
            $user_inactivos_number = Role_user::where('state', 'LIKE', 'INACTIVO')->get();
            $user_inactivos_total = $user_inactivos_number->count();

            /**Indica las tareas de mantenimiento Pendientes */
            $mensajes_noRealizados_number = DB::table('messages')
            ->select('messages.*')
            ->where('messages.sender_id', '=', auth()->id())
            ->whereNull('maintenance_date')->get();
            $mensajes_pendientes_number = $mensajes_noRealizados_number->count();

            /**Indica las tareas de mantenimiento Realizadas o ya finalizadas */
            $mensajes_yaRealizados_number = DB::table('messages')
            ->select('messages.*')
            ->where('messages.sender_id', '=', auth()->id())
            ->where('maintenance_date', '!=', null)->get();
            $mensajes_yaRealizados_number = $mensajes_yaRealizados_number->count();
            
            /**Lista todas los equipos que estan aún en mantenimiento  */
            $mensajes_historial = DB::table('messages')
            ->join('equipment','equipment.id','=','messages.equipment_id')
            ->join('systems', 'systems.id', '=', 'equipment.systems_id')
            ->join('areas', 'areas.id', '=', 'systems.areas_id')
            ->join('locations', 'areas.locations_id', '=', 'locations.id')
            ->join('users','users.id','=','messages.sender_id')
            ->join('locations_user', 'locations_user.locations_id', '=','locations.id')
            ->select(
                'locations.code as code_locations',
                'areas.code as code_areas',
                'systems.code as code_systems',  
                'equipment.code',
                'equipment.image_equipment',
                'messages.id', 
                'equipment_id', 
                'equipment.name', 
                'body', 
                'messages.maintenance_date', 
                'messages.maintenance_report', 
                'messages.created_at', 
                'messages.updated_at'
                )
            //->where('messages.sender_id', '=', auth()->id())
            ->where('equipment.in_maintenance', '=', 'SI')
            ->where('locations_user.user_id', '=', auth()->id())
            ->whereNull('messages.maintenance_date')
            ->paginate(5);

        return view('home',compact('user', 'totalEquiposxLaboratorio_chart', 
        'totalEquiposPrestadosxLaboratorio_chart', 'users_number', 'areas_number', 'user_inactivos_total', 'locations_number', 
        'mensajes_pendientes_number', 'mensajes_yaRealizados_number', 'mensajes_historial'));
    }
}
