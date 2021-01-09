<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidacionLocations;
use App\Locations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class LocationsController extends Controller
{
    public function index()
    {
        $buscar = 'name';
        $tipo = null;
        $constraints = [
            'tipo' => $buscar,
            'buscarpor' => $tipo
        ];

        $locations = $this->conseguirListaDeLocalizaciones($constraints);
        return view('localizaciones.index', 
                    [
                        'locations' => $locations, 
                        'searchingVals' => $constraints
                    ]);
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

        $locations = $this->conseguirListaDeLocalizaciones($constraints);
        return view('localizaciones.index', 
                    [
                        'locations' => $locations, 
                        'searchingVals' => $constraints
                    ]);
    } 

    /**
     * Devuelve la lista de los laboratorios al index
     * disponibles a cargo de un usuario. 
     */
    private function conseguirListaDeLocalizaciones($constraints) 
    {
        $locations=DB::table('locations')
            ->join('locations_user', 'locations_user.locations_id', '=','locations.id')
            ->join('users', 'users.id', 'locations_user.user_id')
            ->select(
                'locations.id as id',
                'locations.code as code',
                'locations.name as name',
                'locations.description as description',
                'locations.telephone as telephone',
                'locations.ext as ext',
                'locations.image_locations as image_locations'
                )
            ->where('locations_user.user_id', '=', auth()->id())
            ->where('locations.'.$constraints['tipo'],'LIKE','%'.$constraints['buscarpor'].'%')
            ->orderBy('locations.name','ASC')
            ->paginate(10);
        return $locations;
    }

    public function create()
    {
        return view('localizaciones.create');
    }

    public function store(ValidacionLocations $request)
    {
        $datoLocalizacion=request()->except('_token');
        try{
            if($request->hasFile('image_locations')){
                $datoLocalizacion['image_locations'] = $request->file('image_locations')->store('uploads/laboratoriosImagenes','public');
                Locations::create([
                    'code' => $request['code'],
                    'name' => $request['name'],
                    'description' => $request['description'],
                    'telephone' => $request['telephone'],
                    'ext' => $request['ext'],
                    'image_locations' => $datoLocalizacion['image_locations']
                ]);
            }else{
                Locations::create([
                    'code' => $request['code'],
                    'name' => $request['name'],
                    'description' => $request['description'],
                    'telephone' => $request['telephone'],
                    'ext' => $request['ext']
                ]);
            }

            return redirect()->route('localizaciones.index')->with('success', 'Laboratorio registrado exitosamente. Dirijase al módulo de asignacion de laboratorios.');
        } catch(\Throwable $th) {
            return back()->with('flash-danger', 'Hubo un error =( al registrar el Laboratorio.');
        }
    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $location=Locations::findOrFail($id);
        return view('localizaciones.edit',compact('location'));
    }

    public function update(ValidacionLocations $request, $id)
    {
        $datoLocalizacion=request()->except('_token', '_method');

        if($request->hasFile('image_locations')){
            $buscarID = Locations::findOrFail($id);
            Storage::delete('public/'.$buscarID->image_locations);
            $datoLocalizacion['image_locations'] = $request->file('image_locations')->store('uploads/laboratoriosImagenes','public');
        }

        Locations::where('id','=',$id)->update($datoLocalizacion);
        $buscarID = Locations::findOrFail($id);
        return redirect()->route('localizaciones.index')->with('success','Laboratorio actualizado exitosamente');
    }

    public function show($id)
    {
        $location=Locations::findOrFail($id);
        return view('localizaciones.show',compact('location'));
    }

    public function destroy($id)
    {
        try{
            if(Locations::destroy($id)){
                return redirect()->route('localizaciones.index')->with('success','Laboratorio eliminado exitosamente');
            }else{
                return back()->with('flash-danger', 'Por favor verifiqué que NO este siendo utilizado por una área.');
            }
        }catch(\Throwable $th) {
            return back()->with('flash-danger', 'Por favor verifique que NO este siendo utilizado por una área');
        }     
    }
}
