<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Auth\RegistersUsers;//se modifico para no iniciar sesion
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        //$this->middleware('guest');
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'ci' => 'required|numeric',
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            //'password' => ['required', 'string', 'min:8', 'confirmed'],
            //'password' => ['string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        
        try{
            DB::beginTransaction();
            
            $info_user = $data['ci'];
            $role = Role::findOrFail(3);// el número 3 es el rol de estudiante
            $user = User::create([
                'ci' => $data['ci'],
                'name' => $data['name'],
                'lastname' => $data['lastname'],
                'email' => $data['email'],
                'password' => Hash::make('Epn-'.$info_user),
            ]);
            $role->users()->save($user);
            DB::commit();
            return $user;
        }catch(QueryException $e) {
            DB::rollBack();
            return back()->with('flash-danger', 'HUBO UN ERROR al momento de registrar al nuevo usuario');
        } 
    }
}
