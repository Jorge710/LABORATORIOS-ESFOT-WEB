<?php

namespace App\Http\Controllers;

/**Son Modelos del paquete SHINOBI */

use App\Http\Requests\ValidacionRoles;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class RoleController extends Controller
{
    
    public function index()
    {
        $roles = Role::orderBy('roles.name','ASC')->paginate(10);
        return view('roles.index', compact('roles'));
    }

    
    public function create()
    {
        $permissions = Permission::get();
        return view('roles.create', compact('permissions'));
    }

    
    public function store(ValidacionRoles $request)
    {
        try {
            $role = Role::create($request->all());
        
            //Actualizo Permisos
            $role->permissions()->sync($request->get('permissions'));
            
            return redirect()->route('roles.edit', $role->id)
            ->with('flash-sucsess','Rol guardado con exito');
        } catch (\Throwable $th) {
            return back()->with('flash-danger', 'HUBO UN ERROR');
        }
    }

    public function show(Role $role)
    {
        return view('roles.show', compact('role'));
    }

    public function edit($id)
    {
        $role = Role::find($id);
        
        $permissions_usuarios = DB::table('permissions')
            ->select('permissions.*')
            ->where('permissions.module', 'LIKE', 'usuarios')
            ->orWhere('permissions.module', 'LIKE', 'roles')
            ->get();
        $permissions_localizaciones = DB::table('permissions')
            ->select('permissions.*')
            ->where('permissions.module', 'LIKE', 'localizaciones')
            ->get();
        $permissions_areas = DB::table('permissions')
            ->select('permissions.*')
            ->where('permissions.module', 'LIKE', 'areas')
            ->get();
        $permissions_sistemas = DB::table('permissions')
            ->select('permissions.*')
            ->where('permissions.module', 'LIKE', 'sistemas')
            ->get();
        $permissions_equipos = DB::table('permissions')
            ->select('permissions.*')
            ->where('permissions.module', 'LIKE', 'equipos')
            ->orWhere('permissions.module', 'LIKE', 'equiposprestamos')
            ->get();
        $permissions_elementos = DB::table('permissions')
            ->select('permissions.*')
            ->where('permissions.module', 'LIKE', 'elementos')
            ->get();
        $permissions_criticidades = DB::table('permissions')
            ->select('permissions.*')
            ->where('permissions.module', 'LIKE', 'criticidades')
            ->get();
        $permissions_messages = DB::table('permissions')
            ->select('permissions.*')
            ->where('permissions.module', 'LIKE', 'messages')
            ->get();
        $permissions_reportdownload = DB::table('permissions')
            ->select('permissions.*')
            ->where('permissions.module', 'LIKE', 'reportdownload')
            ->orWhere('permissions.module', 'LIKE', 'datasheetdownload')
            ->orWhere('permissions.module', 'LIKE', 'equipmentmanualdownload')
            ->get();
        $permissions_page = DB::table('permissions')
            ->select('permissions.*')
            ->where('permissions.module', 'LIKE', 'page')
            ->get();
        $permissions_mantenimientos = DB::table('permissions')
            ->select('permissions.*')
            ->where('permissions.module', 'LIKE', 'mantenimientos')
            ->get();

        return view('roles.edit', compact('role', 
            'permissions_usuarios', 'permissions_roles', 'permissions_localizaciones', 'permissions_areas', 'permissions_sistemas',
            'permissions_equipos', 'permissions_elementos', 'permissions_criticidades', 'permissions_equiposprestamos', 'permissions_messages', 
            'permissions_reportdownload', 'permissions_datasheetdownload', 'permissions_equipmentmanualdownload', 'permissions_page', 'permissions_asignarLocalizacion',
            'permissions_mantenimientos'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        //Actualizar ROl
        $role->update($request->all());
        /**para actulizar 2 tablas a la vez SYNC*/
        //Actualizar Permisos
        $role->permissions()->sync($request->get('permissions'));
        
        return redirect()->route('roles.edit', $role->id)
        ->with('flash-success','Rol actualizado con exito');
    }

    public function destroy(Role $role)
    {
        try {
            DB::beginTransaction();
            $role->delete();
            DB::commit();
            return back()->with('flash-success','Rol eliminado correctamente.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('flash-danger', 'Por favor verifiqué que no exista usuarios con este rol asignado.');
        }  
    }
}
