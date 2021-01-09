<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use App\Http\Requests\ValidacionAvatar;
use App\Http\Requests\ValidacionDatosUsuario;
use App\Http\Requests\ValidacionRegistros;
use App\Http\Requests\ValidacionUpdateAsignacionLaboratorio;
use App\Http\Requests\ValidacionUpdateRolesUsuario;
use App\Locations;
use App\LocationsUsers;
use App\User;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Foundation\Auth\RegistersUsers;//se modifico para no iniciar sesion
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    use RegistersUsers;

    public function index(Request $request)
    {       
        $users_list = User::with('roles:roles.name')->paginate(10);
        return view('users.index', ['users_list' => $users_list]);
    }

    public function search(Request $request) 
    {
        $constraints = [
            'tipo' => $request['tipo'],
            'buscarpor' => $request['buscarpor']
        ];

        $members = User::with('roles:roles.name');
        $users_list = null;

        if ($constraints['tipo'] && $constraints['buscarpor']) {
            switch ($constraints['tipo']) {
                case "name":
                    $users_list = $members->where('name', 'LIKE', '%'.$constraints['buscarpor'].'%')->paginate(10);
                    break;
                case "lastname":
                    $users_list = $members->where('lastname', 'LIKE', '%'.$constraints['buscarpor'].'%')->paginate(10);
                    break;
                case "email":
                    $users_list = $members->where('email', 'LIKE', '%'.$constraints['buscarpor'].'%')->paginate(10);
                    break;
                case "ci":
                    $users_list = $members->where('ci', 'LIKE', '%'.$constraints['buscarpor'].'%')->paginate(10);
                    break; 
                case "cargo":
                    try {
                        $value = $constraints['buscarpor'];
                        $rol_usuario = Role::where('slug', $value)->first();
                        
                        $members = $rol_usuario->users();
                    
                        $users_list = $members->orderBy('lastname', 'asc')->paginate(10);
                        
                    } catch (\Throwable $th) {
                        return back()->with('flash-danger', 'Verifique el nombre del cargo.');
                    }
                    break;   
                default:
                    return abort(404);
                    break;
            }
        }

        return view('users.index', ['users_list' => $users_list, 'searchingVals' => $constraints]);
    } 

    private function consegirListaDeUsuarios($constraints) 
    {
        $users_list = User::with('roles:roles.name')
            ->where('users.id', '!=', auth()->id())
            ->where('users.'.$constraints['tipo'],'LIKE','%'.$constraints['buscarpor'].'%')
            ->orderBy('users.lastname','ASC')
            ->paginate(10);

            return $users_list;
    }
    
    protected function create()
    {
        $locations = Locations::get();
        return view('users.create', compact('locations'));
    }

    protected function store(ValidacionRegistros $request)
    {
        $datoUsuario=request()->except('_token');
  
        try{
            DB::beginTransaction();

            $info_user = $request['ci'];
            $role = Role::findOrFail(2);// el número 2 es el rol de estudiante

            if($request->hasFile('avatar')){
                $datoUsuario['avatar'] = $request->file('avatar')->store('uploads/usuariosImagenes','public');
                $user = User::create([
                    'ci' => $request['ci'],
                    'name' => $request['name'],
                    'lastname' => $request['lastname'],
                    'email' => $request['email'],
                    'password' => Hash::make('Epn-'.$info_user),
                    'avatar' => $datoUsuario['avatar'],
                ]);
            }else{
                $user = User::create([
                    'ci' => $request['ci'],
                    'name' => $request['name'],
                    'lastname' => $request['lastname'],
                    'email' => $request['email'],
                    'password' => Hash::make('Epn-'.$info_user),
                ]);

            }

            $role->users()->save($user);
            $user->locations()->sync($request->get('locations'));
            $user->sendEmailVerificationNotification();
            DB::commit();
            return redirect()->route('users.index')
            ->with('flash-success','Usuario registrado con exito');
        }catch(\Throwable $th) {
            DB::rollBack();
            return back()->with('flash-danger', 'HUBO UN ERROR al momento de registrar al nuevo usuario');
        }
    }

    public function show($id)
    {
        try {
            $id =  Crypt::decrypt($id);
            $user=User::findOrFail($id);
            return view('users.show',compact('user'));
        } catch (\Throwable $th) {
            return back();
        }
    }

    public function edit($id)
    {
        $locations = Locations::get();
        
        $usersEdit = User::find($id);
        
        try {
            $id = Crypt::decrypt($id);
            $user = User::findOrFail($id);

            $info = DB::table('users')
                ->join('role_user', 'users.id', '=', 'role_user.user_id')
                ->select(
                    'users.name as user_nomb',
                    'users.id as users_id',
                    'role_user.role_id as userroleID_id',
                    'role_user.user_id as useruser_id'
                )
                ->where('role_user.user_id', '=', $user->id)
                ->get();

            $roles = Role::get();
            return view('users.edit', compact('user', 'roles','info','usersEdit','locations'));
        } catch (\Throwable $th) {
            return back();
        }
    }

    public function update(ValidacionRegistros $request, User $user)
    {
        try{
            //DB::beginTransaction();
            $user->update($request->all());
            /**para actulizar 2 tablas a la vez SYNC*/
            //$user->roles()->sync($request->get('roles'));
            //$user->locations()->sync($request->get('locations'));
            //DB::commit();
            //return redirect()->route('users.edit', $user->id)
            return redirect()->route('users.index')
            ->with('flash-success','Usuario actualizado con exito');
        }catch(\Throwable $th) {
            //DB::rollBack();
            return back()->with('flash-danger', 'HUBO UN ERROR');
        }
    }

    public function updateRol(Request $request, User $user)
    {
        try{
            //DB::beginTransaction();
            $user->update($request->all());
            /**para actulizar 2 tablas a la vez SYNC*/
            $user->roles()->sync($request->get('roles'));
            //DB::commit();
            //return redirect()->route('users.edit', $user->id)
            return redirect()->route('users.index')
            ->with('flash-success','Usuario actualizado con exito');
        }catch(\Throwable $th) {
            //DB::rollBack();
            return back()->with('flash-danger', 'HUBO UN ERROR');
        }
    }

    public function updateASignacionLaboratorio(Request $request, User $user)
    {
        try{
            //DB::beginTransaction();
            $user->update($request->all());
            /**para actulizar 2 tablas a la vez SYNC*/
            $user->locations()->sync($request->get('locations'));
            //DB::commit();
            //return redirect()->route('users.edit', $user->id)
            return redirect()->route('users.index')
            ->with('flash-success','Usuario actualizado con exito');
        }catch(\Throwable $th) {
            //DB::rollBack();
            return back()->with('flash-danger', 'HUBO UN ERROR');
        }
    }

    public function destroy(User $user)
    {
        try{
            DB::beginTransaction();
                        
            $cambiar_state_a = 'INACTIVO';
                
                DB::table('role_user')
                ->where('role_user.user_id',$user->id)
                ->update([ 'state' => $cambiar_state_a ]);

            DB::commit();
            return back()->with('flash-success','El usuario pasara su state a INACTIVO');
        }catch(\Throwable $th) {
            DB::rollBack();
            return back()->with('flash-danger', 'HUBO UN ERROR');
        }
    }

    /**
     * FUNCIONES EXTRAS 
     * */
    public function ver($id){
        try {
            $id =  Crypt::decrypt($id);
            
            $user=User::findOrFail($id);
            return view('users.profile',compact('user'));
        } catch (\Throwable $th) {
            return back();
        }
      }

    /**Para el formulario de actualizar el avatar */
    public function updateAvatar(ValidacionAvatar $request, $id)
    {
        try {
            $datoUsuario=request()->except('_token', '_method');

            if($request->hasFile('avatar')){
                $buscarID = User::findOrFail($id);
                Storage::delete('public/'.$buscarID->avatar);
                $datoUsuario['avatar'] = $request->file('avatar')->store('uploads/usuariosImagenes','public');
            }
            
            User::where('id','=',$id)->update($datoUsuario);
            $buscarID = User::findOrFail($id);
            return back()->with('flash-success','Usuario actualizado exitosamente');
        } catch (\Throwable $th) {
            return back()->with('flash-danger', 'HUBO UN ERROR');
        }
    }

    /**Para el formulario de actualizar la contraseña */
    public function updatePassword(Request $request, $id)
    {
        $id =  Crypt::decrypt($id);
        
        $user=User::findOrFail($id);
        
        try {
            DB::beginTransaction();
            $data = User::find($user->id);
           
            if( Hash::check( $request['old_password'], $data->password ) && $user->id === (Auth::user()->id))
            {
                $request->validate([
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                    'password' => ['string', 'min:8', 'confirmed'],
                ]);
        
                $request->merge([
                    'password' => Hash::make($request->input('password'))
                ]);
        
                
                User::findOrFail($user->id)->update($request->all());
                
                DB::commit();
                return back()->with('flash-success','El usuario cambio su contraseña');
            }else{
                DB::rollBack();
                return back()->with('flash-danger', 'Hubo un error al cambiar la contraseña verifique que sea el correcto!!!');
            }
            
        } catch (\Throwable $th) {
            return back()->with('flash-danger', 'HUBO UN ERROR');
        }
    }

    /**Para el formulario de actualizar el datos personales */
    public function updateDatosUsuario(ValidacionDatosUsuario $request, $id)
    {
        try {
            $datoUsuario=request()->except('_token', '_method');
            
            User::where('id','=',$id)->update($datoUsuario);
            return back()->with('flash-success','Usuario actualizado exitosamente');
        } catch (\Throwable $th) {
            return back()->with('flash-danger', 'HUBO UN ERROR');
        }
    }

    public function activar(User $user)
    {
        $cambiar_state_a = 'ACTIVO';
            
            DB::table('role_user')
            ->where('role_user.user_id',$user->id)
            ->update([ 'state' => $cambiar_state_a ]);
        return back()->with('flash-success','El usuario pasa su estado ACTIVO y retoma su cargo.');

    }

    public function eliminar_completamente_user(User $user)
    {
        try {
            DB::beginTransaction();
            $user->delete();
            DB::commit();
            return back()->with('flash-success','El usuario elimanado Completamente');
        } catch (\Throwable $th) {
            return back()->with('flash-danger','Verifique que el usuario haya terminado todos los mantenimientos pendientes.');
            DB::rollBack();
        }

    }

    public function exportar_users_excel()
    {
        return Excel::download(new UserExport, 'users-list.xlsx');
    }
}
