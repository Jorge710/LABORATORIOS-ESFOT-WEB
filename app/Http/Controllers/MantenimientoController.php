<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;

class MantenimientoController extends Controller
{

    public function index()
    {
        date_default_timezone_set('America/Guayaquil');
        $format = 'Y-m-d H:i:s';
        $now = date($format);
        $to = date($format, strtotime("+30 days"));

        $constraints = [
            'from' => $now,
            'to' => $to
        ];
        

        $mensajes_historial = $this->getReportMaintenance($constraints);
        return view('mantenimientos.index', ['mensajes_historial' => $mensajes_historial, 'searchingVals' => $constraints], compact('pasantes'));
    }

    public function create()
    {
    }

    public function search(Request $request) 
    {
        $constraints = [

            'from' => $request['from'],
            'to' => date('Y-m-d H:i:s')
        ];

        $pasantes = $this->conseguirPasantes();
        $mensajes_historial = $this->getReportMaintenance($constraints);
        return view('mantenimientos.index', ['mensajes_historial' => $mensajes_historial, 'searchingVals' => $constraints], compact('pasantes'));
    }

    public function exportPDF(Request $request) 
    {
        $constraints = [

            'from' => $request['from'],
            'to' => date('Y-m-d H:i:s')
        ];

        $pasantes = $this->conseguirPasantes();
        $mensajes_historial = $this->getReportMaintenance($constraints);
        $pdf = PDF::loadView('mantenimientos.pdf', compact('mensajes_historial'));

        return $pdf->setPaper('a4', 'landscape')->download('mantenimientos-list.pdf');
    }

    public function conseguirPasantes()
    {
        $pasantes = DB::table('messages')
        ->join('users', 'messages.sender_id', '=', 'users.id')
        ->select(
            'messages.id',
            'sender_id',
            'recipient_id',
            'equipment_id',
            'body',
            'maintenance_report',
            'maintenance_date',
            'commissioned',
            'messages.created_at',
            'messages.updated_at'
        ) 
        ->where('messages.sender_id', '=', auth()->id())
        ->get();

        return $pasantes;
    }

    public function getReportMaintenance($constraints)
    {
        $mensajes_historial = DB::table('messages')
            ->join('equipment','equipment.id','=','messages.equipment_id')
            ->join('users','users.id','=','messages.sender_id')
            ->join('systems', 'systems.id', '=', 'equipment.systems_id')
            ->join('areas', 'areas.id', '=', 'systems.areas_id')
            ->join('locations', 'areas.locations_id', '=', 'locations.id')
            //->join('users','users.id','=','messages.sender_id')
            ->join('locations_user', 'locations_user.locations_id', '=','locations.id')
            ->select(
                'equipment.code',
                'equipment.image_equipment',
                'messages.id', 
                'equipment_id', 
                'equipment.name', 
                'body', 
                'users.name as nameUser',
                'users.lastname as lastnameUser',
                'messages.maintenance_date', 
                'messages.maintenance_report', 
                'messages.commissioned',
                'messages.created_at', 
                'messages.updated_at',
                'locations.code as code_locations',
                'areas.code as code_areas',
                'systems.code as code_systems'
                )
            //->where('messages.sender_id', '=', auth()->id())
            ->where('locations_user.user_id', '=', auth()->id())
            ->where('messages.created_at', '>=', $constraints['from'])
            ->where('messages.created_at', '<=', $constraints['to'])
            ->paginate(10);

        return $mensajes_historial;
    }

    public function destroy($id)
    {
        try{
            if(Message::destroy($id)){
                return back()->with('success','Mensaje eliminado exitosamente');
            }else{
                return back()->with('flash-danger', 'Hubo un error al eliminar el mensaje.');
            }
        }catch(\Throwable $th) {
            return back()->with('flash-danger', 'Hubo un error al eliminar el mensaje.');
        } 
    }
}
