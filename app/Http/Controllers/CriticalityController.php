<?php

namespace App\Http\Controllers;

use App\Criticalities;
use App\Availabilities;
use App\Equipment;
use App\Exports\CriticalitiesExport;
use App\Http\Requests\Validacioncriticalities;
use App\MaintenanceModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Facades\Excel;

class CriticalityController extends Controller
{

    public function index()
    {
        /**
         * El index de los equipos , elementos y criticidades se elimino 
         * ya que se encuentra en la parte show de los equipos se utilizo los tabs
         */
    }

    public function create($id)
    {
        $buscarID_equipo = Equipment::findOrFail($id);

        $equipment = DB::table('equipment as e')
        ->join('systems as s','e.systems_id','=','s.id')
        ->join('areas', 'areas.id', '=', 's.areas_id')
        ->join('locations as l','areas.locations_id','=','l.id')
        ->join('locations_user', 'locations_user.locations_id', '=','l.id')
        ->join('users', 'users.id', 'locations_user.user_id')
        ->select(
            'e.id as id',
            'e.code as code',
            'e.name as name'
            )
        ->where('locations_user.user_id', '=', auth()->id())
        ->where('e.assign_criticality', 'LIKE','DISPONIBLE')
        ->where('e.id', '=',$id)
        ->get();

        $maintenance_model = MaintenanceModel::all();
        $availabilities = Availabilities::all();
        return view('criticidades.create', compact('equipment', 'maintenance_model', 'availabilities', 'buscarID_equipo'));
    }

    public function store(ValidacionCriticalities $request)
    {
        if($request->consequences != 'NaN' && $request->total != 'NaN'){
            DB::select('CALL sp_insertar_criticidad(?,?,?,?,?,?,?,?,?,?)', 
                [
                    $request->equipment_id, 
                    $request->frequency, 
                    $request->operationalImpact,
                    $request->flexibility, 
                    $request->maintenanceCost, 
                    $request->impactToSafety,
                    $request->consequences, 
                    $request->total, 
                    $request->availabilities_id,
                    $request->maintenance_model_id
                ]);
            /**Se cambia el estado a OCUPADO del campo cuando se le asigna a un equipo la criticidad */
            $cambiar_estado_a = 'OCUPADO';

            DB::table('equipment')
                ->where('id',$request['equipment_id'])
                ->update([ 'assign_criticality' => $cambiar_estado_a ]);

            return redirect()->route('equipos.show',Crypt::encrypt($request['equipment_id']))->with('flash-success', 'Datos añadidos exitosamente.');
        }else{
            return back()->with('flash-danger', 'Hubo un error al registrar verifique el campo Consecuencia y Total.');
        }
        
    }

    public function show($id)
    {
        $criticalities = DB::select('CALL sp_showCriticidad(?)', [$id]);
        return view('criticalities.show',compact('criticalities'));
    }

    public function edit($id)
    {
        $criticalities=Criticalities::findOrFail($id);
        
        /**Para comparar todos los equipos en el select del formulario*/
        $equipment_select = DB::table('equipment as e')
        ->join('systems as s','e.systems_id','=','s.id')
        ->join('areas', 'areas.id', '=', 's.areas_id')
        ->join('locations as l','areas.locations_id','=','l.id')
        ->join('locations_user', 'locations_user.locations_id', '=','l.id')
        ->join('users', 'users.id', 'locations_user.user_id')
        ->select(
            'e.id as id',
            'e.code as code',
            'e.name as name'
            )
        ->where('locations_user.user_id', '=', auth()->id())
        ->where('e.id', '=', $criticalities->equipment_id)
        ->get();

        $maintenance_model = MaintenanceModel::all();
        $availabilities = Availabilities::all();
        
        return view('criticidades.edit',compact('criticalities','maintenance_model','availabilities', 'equipment', 'equipment_select'));
    }

    public function update(ValidacionCriticalities $request, $id)
    {
        Criticalities::findOrFail($id)->update($request->all());
        return redirect()->route('equipos.show',Crypt::encrypt($request['equipment_id']))->with('flash-success','Criticidad actualizada exitosamente');
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $buscarID = Criticalities::findOrFail($id);
            $cambiar_estado_a = 'DISPONIBLE';
                
                DB::table('equipment')
                ->where('id',$buscarID['equipment_id'])
                ->update([ 'assign_criticality' => $cambiar_estado_a ]);
                Criticalities::destroy($id);
            DB::commit();
            return back()->with('flash-success', 'Eliminado Correctamente.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('flash-danger', 'HUBO UN ERROR, Verifique!');
        }
    }

    public function exportar_criticidades_excel()
    {
        return Excel::download(new CriticalitiesExport, 'criticidades-list.xlsx');
    }
}
