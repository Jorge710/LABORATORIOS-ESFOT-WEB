<?php

namespace App\Exports;

use App\Equipos_prestamos;
use App\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class UserExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $users = DB::table('users')
        ->join('role_user', 'role_user.user_id', 'users.id')
        ->join('roles', 'role_user.role_id', 'roles.id')
        ->select(
            'users.ci as ci',
            'users.name as name',
            'users.lastname as lastname',
            'users.email as email',
            'role_user.state as state',
            'roles.name as nameRol'
        )
        ->get();
        return view('users.excel_exports',compact('users'));
    } 
}
