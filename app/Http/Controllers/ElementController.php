<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Elements;
use App\Equipment;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ValidacionElements;
use Illuminate\Support\Facades\Storage;
use App\Classifications;
use App\MaintenanceFrequency;
use App\TypeFailures;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Crypt;

class ElementController extends Controller
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
        //para crear un nuevo elemento en el equipo actual seleccionado
        $buscarID_equipo = Equipment::findOrFail($id);
        //para la lista desplegable
        $infoEquipos = Equipment::all();

        $elements=Elements::all();
        $type_failures = TypeFailures::all();
        $classifications = Classifications::all();
        $maintenance_frequency = MaintenanceFrequency::all();
        return view('elementos.create', compact('infoEquipos','elements',
        'type_failures','classifications','maintenance_frequency', 'buscarID_equipo'));
    }

    public function store(ValidacionElements $request)
    {
        try{
            DB::beginTransaction();
            $datoElemento = request()->except('_token');
            if($request->hasFile('image_elements')){
                $datoElemento['image_elements'] = $request->file('image_elements')->store('uploads/elementosImagenes','public');  
            } 
            Elements::create([
                'equipment_id' => $request['equipment_id'],
                'name' => $request['name'],
                'number_of' => $request['number_of'],
                'description' => $request['description'],
                'function' => $request['function'],
                'image_elements' => $datoElemento['image_elements'],
                'faultDescription' => $request['faultDescription'],
                'typefailures_id' => $request['typefailures_id'],
                'failMode' => $request['failMode'],
                'classifications_id' => $request['classifications_id'],
                'maintenanceActivity' => $request['maintenanceActivity'],
                'maintenanceTask' => $request['maintenanceTask'],
                'improvements' => $request['improvements']
            ]); 
            DB::commit();
            return redirect()->route('equipos.show',Crypt::encrypt($request['equipment_id']))->with('flash-success', 'Datos añadidos exitosamente.');
        }catch(\Throwable $th) {
            DB::rollBack();
            return back()->with('flash-danger', 'HUBO UN ERROR al momento de crear un nuevo elemento');
        }
    }

    public function show($id)
    {
        $elem = DB::select('call sp_showelements(?)', [$id]); 
        $elements=Elements::findOrFail($id);
        return view('elementos.show',compact('elements','elem'));
    }

    public function edit($id)
    {
        $elements=Elements::findOrFail($id);
       
        $infoEquipos = DB::table('equipment as e')
        ->select(
            'e.id as id',
            'e.code as code',
            'e.name as name'
            )
        ->where('e.id', '=',$elements->equipment_id)
        ->get();

        $elements = DB::select('call sp_showelementsEdit(?)', [$id]);
        $type_failures = TypeFailures::all();
        $classifications = Classifications::all();
        $maintenance_frequency = MaintenanceFrequency::all();
        return view('elementos.edit',compact('elements','infoEquipos','type_failures','classifications','maintenance_frequency'));
    }

    public function update(ValidacionElements $request, $id)
    {
        $datoElemento=request()->except('_token', '_method');
        
        $equi_encriptado = Crypt::encrypt($datoElemento['equipment_id']);

        if($request->hasFile('image_elements')){
            $buscarID = Elements::findOrFail($id);
            Storage::delete('public/'.$buscarID->image_elements);
            $datoElemento['image_elements'] = $request->file('image_elements')->store('uploads/elementosImagenes','public');
        }
        
        Elements::where('id','=',$id)->update($datoElemento);
        $buscarID = Elements::findOrFail($id);
        return redirect()->route('equipos.show',$equi_encriptado)->with('flash-success','Elemento actualizado exitosamente');
    }

    public function destroy($id)
    {
        $buscarID = Elements::findOrFail($id);
        if(Storage::delete('public/'.$buscarID->image_elements)){  
            Elements::destroy($id);
            return back()->with('flash-success','Elemento eliminado exitosamente');
        }else{
            return back()->with('flash-danger', 'HUBO UN ERROR al momento de eliminar el elemento');
        }    
    }
}
