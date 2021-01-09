<?php

namespace App\Http\Controllers;

use App\Equipment;
use App\Exports\EquipmentExport;
use App\MaintenanceFrequency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ValidacionEquipment;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage; //Libreria STORAGE para el manejo de archivos como image_equipmentes y documetos
use Maatwebsite\Excel\Facades\Excel;

class EquipmentController extends Controller
{
    public function index()
    {
        /**
         * El index de los equipos , elementos y criticidades se elimino 
         * ya que se encuentra en la parte show de los equipos se utilizo los tabs
         */
    }

    public function create()
    {
        $maintenance_frequency = MaintenanceFrequency::all();
        $areas = DB::select('CALL sp_mostrarAreasLab(?)', [auth()->id()]);
        $systems=DB::table('systems')->get();
        return view('equipos.create', compact('systems', 'areas', 'maintenance_frequency'));
    }

    public function store(ValidacionEquipment $request)
    {
        $datoEquipo=request()->except('_token');
        try{
            if($request->hasFile('image_equipment')){
                $datoEquipo['image_equipment'] = $request->file('image_equipment')->store('uploads/equipoImagenes','public');
            }
            if($request->hasFile('datasheet')){
                $datoEquipo['datasheet'] = $request->file('datasheet')->store('uploads/fichasTecnicas','public');
            }
            if($request->hasFile('handbook')){
                $datoEquipo['handbook'] = $request->file('handbook')->store('uploads/manualesTecnicos','public');
                Equipment::create([
                    'id' => $request['id'],
                    'code' => $request['code'],
                    'systems_id' => $request['systems_id'],
                    'name' => $request['name'],
                    'description' => $request['description'],
                    'function' => $request['function'],
                    'recommendation' => $request['recommendation'],
                    'maintenance' => $request['maintenance'],
                    'image_equipment' => $datoEquipo['image_equipment'],
                    'datasheet' => $datoEquipo['datasheet'],
                    'handbook' => $datoEquipo['handbook'],
                    'maintenance_frequency_id' => $request['maintenance_frequency_id']
                ]);
    
            }else{
                Equipment::create([
                    'id' => $request['id'],
                    'code' => $request['code'],
                    'systems_id' => $request['systems_id'],
                    'name' => $request['name'],
                    'description' => $request['description'],
                    'function' => $request['function'],
                    'recommendation' => $request['recommendation'],
                    'maintenance' => $request['maintenance'],
                    'image_equipment' => $datoEquipo['image_equipment'],
                    'datasheet' => $datoEquipo['datasheet'],
                    'maintenance_frequency_id' => $request['maintenance_frequency_id'] 
                ]);    
            }           
            return redirect()->route('sistemas.show',Crypt::encrypt($request['systems_id']))->with('success', 'Equipo registrado exitosamente.');
        }catch(\Throwable $th) {
           return back()->with('flash-danger', 'Hubo un error =( al momento de registrar un equipo.');
        }  
    }

    public function show($id)
    {
        $id = Crypt::decrypt($id);
        
        /**lista todos los usuarios para enviar las notificaciones */
        $users = DB::select('CALL sp_messages_users(?)', [auth()->id()]);
        $equipment_para_maintenance = Equipment::all();
        $informacion_equipo = DB::select('call sp_mostrarEquipo(?)', [$id]);
        $informacion_criticidad = DB::select('call sp_mostrarCriticidad(?)', [$id]);
        $informacion_elemento = DB::select('call sp_mostrarElementos(?)', [$id]);//para el modal de los elementos
        $buscarID_equipo = Equipment::findOrFail($id);
        
        return view('equipos.show',compact('buscarID_equipo','informacion_equipo','infoequipment',
        'informacion_elemento','users','equipment_para_maintenance','informacion_criticidad',
        'infoequipment','Elements','Typefailures','Classifications','Maintenancefrequency'));
    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $areas = DB::select('CALL sp_mostrarAreasLab(?)', [auth()->id()]);
        $systems=DB::table('systems')->get();
        $infoequipment = Equipment::all();
        $equipo=Equipment::findOrFail($id);

        $maintenance_frequency = MaintenanceFrequency::all();//para el formulario de los equipos
        
        return view('equipos.edit',compact('equipo', 'systems','infoequipment', 'info_sistema','data', 'areas', 'maintenance_frequency'));
    }

    public function update(ValidacionEquipment $request, $id)
    {
        $datoEquipo=request()->except('_token', '_method');

        if($request->hasFile('image_equipment')){
            $buscarID = Equipment::findOrFail($id);
            Storage::delete('public/'.$buscarID->image_equipment);
            $datoEquipo['image_equipment'] = $request->file('image_equipment')->store('uploads/equipoImagenes','public');
        }
        if($request->hasFile('handbook')){
            $buscarID = Equipment::findOrFail($id);
            Storage::delete('public/'.$buscarID->handbook);
            $datoEquipo['handbook'] = $request->file('handbook')->store('uploads/manualesTecnicos','public');  
        }
        if($request->hasFile('datasheet')){
            $buscarID = Equipment::findOrFail($id);
            Storage::delete('public/'.$buscarID->datasheet);
            $datoEquipo['datasheet'] = $request->file('datasheet')->store('uploads/fichasTecnicas','public');  
        }
    
        Equipment::where('id','=',$id)->update($datoEquipo);
        $buscarID = Equipment::findOrFail($id);
        return redirect()->route('sistemas.show',Crypt::encrypt($request['systems_id']))->with('success','Equipo actualizado exitosamente');
    }

    public function destroy($id)
    {
        try{
            $buscarID = Equipment::findOrFail($id);
            Storage::delete('public/'.$buscarID->handbook);
            if(Equipment::destroy($id)){  
                Storage::delete('public/'.$buscarID->image_equipment);
                Storage::delete('public/'.$buscarID->datasheet);
                return back()->with('success','Equipo eliminado exitosamente');
            }else{
                return back()->with('flash-danger', 'Por favor verifiqué que los Elementos de este equipo se haya eliminado primero.');
            }
        }catch(\Throwable $th) {
            return back()->with('flash-danger', 'Por favor verifiqué que los Elementos de este equipo se haya eliminado primero.');
        } 
    }

    /**Descargar manuales técnicos de los equipos */
    public function downloadManual($id)
    {
        $buscarID = Equipment::findOrFail($id);
        if($buscarID['handbook'] == null){
            return back()->with('flash-danger', 'HUBO UN ERROR AL MOMENTO DE DESCARGAR EL MANUAL TÉCNICO!');
        }else{
            $file = public_path().'/'.'storage/'.$buscarID->handbook;
            return response()->download($file);              
        }
    }

    /**Descragar las fichas técnicos de los equipos */
    public function downloadFichaTecnica($id)
    {
        $buscarID = Equipment::findOrFail($id);
        if($buscarID['datasheet'] == null){
            return back()->with('flash-danger', 'HUBO UN ERROR AL MOMENTO DE DESCARGAR LA FICHA TÉCNICA');
        }else{
            $buscarID = Equipment::findOrFail($id);
            $file = public_path().'/'.'storage/'.$buscarID->datasheet;
            return response()->download($file);
        }
    }

    /**Exportar todos los equipos en formato Excel */
    public function exportar_equipos_excel()
    {
        return Excel::download(new EquipmentExport, 'equipos-list.xlsx');
    }
}
