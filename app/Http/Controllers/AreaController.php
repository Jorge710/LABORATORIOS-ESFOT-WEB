<?php

namespace App\Http\Controllers;

use App\Areas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ValidacionAreas;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class AreaController extends Controller
{
    public function index()
    {
        $buscar = 'name';
        $tipo = null;
        $constraints = [
            'tipo' => $buscar,
            'buscarpor' => $tipo
        ];

        $areas = $this->getAreaList($constraints);
        return view('areas.index', ['areas' => $areas, 'searchingVals' => $constraints]);
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

        $areas = $this->getAreaList($constraints);
        return view('areas.index', ['areas' => $areas, 'searchingVals' => $constraints]);
    } 

    /**
     * Devuelve la lista de áreas al index
     */
    private function getAreaList($constraints) 
    {
        $areas = DB::table('areas as a')
            ->join('locations', 'a.locations_id', '=', 'locations.id')
            ->join('locations_user', 'locations_user.locations_id', '=','locations.id')
            ->join('users', 'users.id', 'locations_user.user_id')
            ->select(
                'a.id as id',
                'a.code as code',
                'locations.code as code_loc',
                'a.name as name',
                'a.description as description',
                'users.avatar as avatar',
                'a.image_areas as image_areas'
                )
            ->where('locations_user.user_id', '=', auth()->id())
            ->where('a.'.$constraints['tipo'],'LIKE','%'.$constraints['buscarpor'].'%')
            ->orderBy('a.name','ASC')
            ->paginate(10);

        return $areas;
    }

    public function create()
    {
        /**Llama al procedimiento almacenado de los laboratorios a cargo del usuario autenticado */
        $locations=DB::select('CALL sp_create_localizacion(?)', [auth()->id()]);
        return view('areas.create', compact('locations'));
    }

    public function store(ValidacionAreas $request)
    {
        $datoArea=request()->except('_token');

        try {
            if($request->hasFile('image_areas')){
                $datoArea['image_areas'] = $request->file('image_areas')->store('uploads/areasImagenes','public');
                Areas::create([
                    'code' => $request['code'],
                    'locations_id' => $request['locations_id'],
                    'name' => $request['name'],
                    'description' => $request['description'],
                    'image_areas' => $datoArea['image_areas']
                ]);
            }else{
                Areas::create([
                    'code' => $request['code'],
                    'locations_id' => $request['locations_id'],
                    'name' => $request['name'],
                    'description' => $request['description']
                ]);
            }
            
            return redirect()->route('areas.index')->with('success', 'Área registrada exitosamente.');
        } catch(\Throwable $th) {
            return back()->with('flash-danger', 'Hubo un error =( al registrar el área.');
        } 
    }

    public function show($id)
    {
        $area=Areas::findOrFail($id);
        return view('areas.show',compact('area'));
    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $locations = DB::select('CALL sp_create_localizacion(?)', [auth()->id()]);
        $area=Areas::findOrFail($id);
        return view('areas.edit',compact('area', 'locations'));
    }

    public function update(ValidacionAreas $request, $id)
    {
        $datoArea=request()->except('_token', '_method');

        if($request->hasFile('image_areas')){
            $buscarID = Areas::findOrFail($id);
            Storage::delete('public/'.$buscarID->image_areas);
            $datoArea['image_areas'] = $request->file('image_areas')->store('uploads/areasImagenes','public');
        }

        Areas::where('id','=',$id)->update($datoArea);
        $buscarID = Areas::findOrFail($id);
        return redirect()->route('areas.index')->with('success','Área actualizada exitosamente');
    }

    public function destroy($id)
    {
        try{
            if(Areas::destroy($id)){
                return back()->with('success','Área eliminada exitosamente');
            }else{
                return back()->with('flash-danger', 'Por favor verifiqué que NO este asignado a un Sistema.');
            }
        }catch(\Throwable $th) {
            return back()->with('flash-danger', 'Por favor verifiqué que NO este asignado a un Sistema.');
        } 
    }
}
