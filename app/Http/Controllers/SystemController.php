<?php

namespace App\Http\Controllers;

use App\Exports\SystemsExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ValidacionSystems;
use App\Locations;
use App\MaintenanceFrequency;
use App\SystemsEquipment;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Facades\Excel;

class SystemController extends Controller
{
    public function index()
    {
        $buscar = 'name';
        $tipo = null;
        $constraints = [
            'tipo' => $buscar,
            'buscarpor' => $tipo
        ];

        $systems = $this->conseguirListaDeSistemas($constraints);
        return view('sistemas.index', ['systems' => $systems, 'searchingVals' => $constraints]);
    }

    /**Buscador o filtro de datos
     * captura el tipo de dato y la palabra a buscar.
     */
    public function search(Request $request) 
    {
        $constraints = [
            'tipo' => $request['tipo'],
            'buscarpor' => $request['buscarpor']
        ];

        $systems = $this->conseguirListaDeSistemas($constraints);
        return view('sistemas.index', ['systems' => $systems, 'searchingVals' => $constraints]);
    } 

    /**
     * Devuelve la lista de sistemas al index
     */
    private function conseguirListaDeSistemas($constraints) 
    {
        $systems = DB::table('systems as s')
            ->join('areas as a', 's.areas_id', '=', 'a.id')
            ->join('locations', 'a.locations_id', '=', 'locations.id')
            ->join('locations_user', 'locations_user.locations_id', '=','locations.id')
            ->join('users', 'users.id', 'locations_user.user_id')
            ->select(
                's.id as id',
                'locations.code as loc_code',
                'a.code as area_code',
                's.code as sist_code',
                's.name as name'
                )
            ->where('locations_user.user_id', '=', auth()->id())
            ->where('s.'.$constraints['tipo'],'LIKE','%'.$constraints['buscarpor'].'%') 
            ->orderBy('s.name','ASC')
            ->paginate(10);
        return $systems;
    }

    public function create()
    {
        $areas = DB::table('areas')
        ->join('locations', 'areas.locations_id', '=', 'locations.id')
        ->join('locations_user', 'locations_user.locations_id', '=','locations.id')
        ->join('users', 'users.id', 'locations_user.user_id')
        ->select(
            'locations.code as loc_code',
            'areas.id as area_id',
            'areas.code as area_code'
            )
        ->where('locations_user.user_id', '=', auth()->id())
        ->get();
        $locations = Locations::all();
        return view('sistemas.create', compact('areas','locations'));
    }

    public function store(ValidacionSystems $request)
    {
        try{
            SystemsEquipment::create($request->all());
            return redirect()->route('sistemas.index')->with('success', 'Sistema registrado exitosamente.');
        } catch(\Throwable $th) {
            return back()->with('flash-danger', 'Hubo un error =( al registrar el Sistema.');
        }
    }

    public function show($id)
    {        
        $id = Crypt::decrypt($id);

        $maintenance_frequency = MaintenanceFrequency::all();//para el formulario de los equipos MODO crear

        $buscarID_sistema = SystemsEquipment::findOrFail($id);
        
        /**lista todos los equipos registrados por cada sistemas */
        $constraints = [
            'id' => $id
        ];
        $systems = $this->conseguirListaDeEquiposPorSistema($constraints);
 
        /**Para el select del formulario de registro de equipos */
        $sistemas_select_form = DB::table('systems')
            ->select(
                'systems.id',
                'systems.code',
                'systems.name'
                )
        ->where('systems.id', '=', $id)
        ->paginate(10);  
             
        return view('sistemas.show',compact('systems','buscarID_sistema', 
            'sistemas_select_form', 'maintenance_frequency'));
    }

    /**
     * Devuelve la lista de equipos al show
     */
    private function conseguirListaDeEquiposPorSistema($constraints) 
    {
        $systems = DB::table('systems')
        ->join('equipment', 'systems.id', '=', 'equipment.systems_id')
        ->join('areas', 'areas.id', '=', 'systems.areas_id')
        ->join('locations', 'locations.id', '=', 'areas.locations_id')
        ->join('maintenance_frequency', 'equipment.maintenance_frequency_id', '=', 'maintenance_frequency.id')
        ->select(
            'locations.code as loc_code',
            'locations.name as loc_name',
            'areas.code as area_code',
            'areas.name as area_name',
            'systems.id',
            'systems.code as sist_code',
            'systems.name as sist_name',
            'equipment.id as equi_id',
            'equipment.code as equi_code',
            'equipment.name as equi_name',
            'equipment.image_equipment as equi_imagen',
            'maintenance_frequency.name as equi_frecuencia'
            )
        ->where('equipment.systems_id', '=', $constraints['id'])
        ->paginate(10);

        return $systems;
    }

    public function edit($id)
    { 
        $id = Crypt::decrypt($id);
        
        $areas = DB::table('areas')
        ->join('locations', 'areas.locations_id', '=', 'locations.id')
        ->join('locations_user', 'locations_user.locations_id', '=','locations.id')
        ->join('users', 'users.id', 'locations_user.user_id')
        ->select(
            'locations.code as loc_code',
            'areas.id as area_id',
            'areas.code as area_code'
            )
        ->where('locations_user.user_id', '=', auth()->id())
        ->get();
        $locations = Locations::all();
        $systems=SystemsEquipment::findOrFail($id);
        return view('sistemas.edit',compact('systems', 'areas'));
    }

    public function update(ValidacionSystems $request, $id)
    {
        SystemsEquipment::findOrFail($id)->update($request->all());
        return redirect()->route('sistemas.index')->with('success','Sistema actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        try{
            if(SystemsEquipment::destroy($id)){
                return back()->with('success','systems eliminado exitosamente');
            }else{
                return back()->with('flash-danger', 'Por favor verifiqué que NO este asignado a un Equipo.');
            }           
        }catch(\Throwable $th) {
            return back()->with('flash-danger', 'Por favor verifiqué que NO este asignado a un Equipo.');
        } 
    }

    public function exportar_sistemas_excel()
    {
        return Excel::download(new SystemsExport, 'systems-list.xlsx');
    }
}
