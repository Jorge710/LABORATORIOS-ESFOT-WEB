<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Role_user;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**SOBRE ESCRIBIMOS EL METODO LOGIN() para comparar su estado en activo*/
    public function login(Request $request){
        
        $validacionDatos = $request->validate([
            'email'=>'required|email',
            'password' => 'required|string',
        ],[
            'email.required'=>'El campo email es obligatorio',
            'email.email'=>'Ingrese un email válido',
            'password.required'=>'El campo contraseña es obligatorio'
        ]);

        try {
            //token remember
            $remember = $request->filled('remember');

            //Se obtiene al usuario con el correo eléctronico ingresado
            $verifyUserEmail = User::where('email', $validacionDatos['email'])->first();
            //Se obtiene al usuario por su ID
            $userRol = Role_user::where('user_id', $verifyUserEmail->id)->first();

            //Se verifica si existe un registro con el email ingresado
            if($verifyUserEmail){
                //Se verifica que el usuario con ese email este en estado ACTIVO
                if($userRol['state'] == 'ACTIVO'){
                    if(Auth::attempt($validacionDatos, $remember)){
                        return redirect('home')->with('flash-success', 'Ingreso exitosamente');
                    }else{
                        return redirect('login')->with('flash-danger', 'Las credenciales no son las correctas');
                    }
                }else{
                    return redirect('login')->with('flash-danger', 'Usuario no registrado');
                }
            }else{
                return redirect('login')->with('flash-danger', 'Usuario no registrado');
            }
        } catch (\Throwable $th) {
            return redirect('login')->with('flash-danger', 'Usuario no registrado');
        }
    }
    /**FIN DE LA SOBRE ESCRITURA DEL METODO LOGIN*/
}
