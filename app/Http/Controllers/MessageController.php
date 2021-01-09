<?php

namespace App\Http\Controllers;

use App\Equipment;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\tasks;
use Illuminate\Database\QueryException;

class MessageController extends Controller
{
    /**Marca como leido la notificación. */
    public function leido($id)
    {
        DB::table('notifications')
            ->where('id',$id)
            ->update([ 'read_at' => now() ]);

        $note = DB::table('notifications')
            ->where('id',$id);
        $note->delete();

        $mensajes = DB::table('messages')
            ->join('equipment','equipment.id','=','messages.equipment_id')
            ->join('users','users.id','=','messages.recipient_id')
            ->join('systems', 'systems.id', '=', 'equipment.systems_id')
            ->join('areas', 'areas.id', '=', 'systems.areas_id')
            ->join('locations', 'areas.locations_id', '=', 'locations.id')
            ->select(
                'locations.code as code_locations',
                'areas.code as code_areas',
                'systems.code as code_systems',
                'equipment.code',
                'equipment.image_equipment',
                'messages.id', 'equipment_id', 'equipment.name', 'body', 'messages.created_at', 'messages.updated_at'
                )
            ->where('users.id', '=', auth()->id())
            ->whereNull('maintenance_date')
            ->get();
        return view('mensajes.index',compact('mensajes'));
    }
    
    /**Para el usuario pasante le lista todas las tareas enviadas en el modulo mensajes */
    public function index()
    {
        $mensajes = DB::table('messages')
            ->join('equipment','equipment.id','=','messages.equipment_id')
            ->join('users','users.id','=','messages.recipient_id')
            ->join('systems', 'systems.id', '=', 'equipment.systems_id')
            ->join('areas', 'areas.id', '=', 'systems.areas_id')
            ->join('locations', 'areas.locations_id', '=', 'locations.id')
            ->select(
                'locations.code as code_locations',
                'areas.code as code_areas',
                'systems.code as code_systems',
                'equipment.code',
                'equipment.image_equipment',
                'messages.id', 'equipment_id', 'equipment.name', 'body', 'messages.maintenance_date', 'messages.maintenance_report','messages.created_at', 'messages.updated_at'
                )
            ->where('users.id', '=', auth()->id())
            ->whereNull('maintenance_date')
            ->get();
        
        return view('mensajes.index',compact('mensajes'));
    }

    /**Solo para el usuario Administrador y encargado
     * crea el mensaje de mantenimiento del equipo y es  
     * enviado al usuario pasante.
     */
    public function store(Request $request)
    {
        $userID_encargado = $request['recipient_id'];
        $encargado_mantenimiento = User::findOrFail($userID_encargado);

        $details = Message::create([
            'sender_id' => auth()->id(),
            'recipient_id' => $request->recipient_id,
            'equipment_id' => $request['equipment_id'],
            'commissioned' => $encargado_mantenimiento->name.' '.$encargado_mantenimiento->lastname,
            'body' => $request->body
        ]);

        $cambiar_estado_a = 'SI';
      
        DB::table('equipment')
            ->where('id',$request['equipment_id'])
            ->update([ 'in_maintenance' => $cambiar_estado_a ]);

        User::find($request->recipient_id)->notify(new tasks($details));
        return back()->with('flash-success', 'Tu mensaje a sido enviado.');
    }

    /**Se muestra toda la información del mensaje 
     * y la información del equipo a realizarce el mantenimeinto */
    public function show($id)
    {        
        $buscarID_equipo = Message::findOrFail($id);
        $info = $buscarID_equipo['equipment_id'];
        $informacion_elemento = DB::select('call sp_mostrarElementos(?)', [$info]);
        $informacion_equipo = DB::select('call sp_mostrarEquipo(?)', [$info]);
        
        $mensajes = DB::table('messages')
            ->join('equipment','equipment.id','=','messages.equipment_id')
            ->join('users','users.id','=','messages.recipient_id')
            ->select(
                'equipment.image_equipment',
                'messages.id', 'equipment_id', 'equipment.name', 'body', 'messages.created_at', 'messages.updated_at'
                )
            ->where('users.id', '=', auth()->id())
            ->get();
        $tarea_mensajes = DB::table('messages')
            ->join('equipment','equipment.id','=','messages.equipment_id')
            ->join('users','users.id','=','messages.recipient_id')
            ->select(
                'equipment.code',
                'messages.id', 'equipment_id', 'equipment.name', 'body', 'messages.created_at', 'messages.updated_at'
                )
            ->where('messages.id', '=', $id)
            ->get();
        return view('mensajes.show', compact('mensajes','informacion_elemento', 'informacion_equipo', 'tarea_mensajes'));
    }

    /**Actualiza la fecha de mantenimiento y el informe del mantenimiento. Ademas, se
     * elimina del listado de las tareas pendientes para el usuario Pasante */
    public function mantenimiento(Request $request, $id)
    {
        $devolver = Message::findOrFail($id);
        
        $cambiar_estado_a = 'NO';
        $devolver_actualizar = $devolver['equipment_id'];
        DB::table('equipment')
            ->where('id',$devolver_actualizar)
            ->update([ 'in_maintenance' => $cambiar_estado_a ]);

        Message::findOrFail($id)->update($request->all());

        Message::where('id', $id)->whereNull('maintenance_date')->update(
            [
                'maintenance_date' => date('Y-m-d H:i:s')
            ]
        );
        return back()->with('flash-success', 'Mantenimiento Realizado');
    }
}
