<?php

namespace App\Http\Controllers;

use App\Equipment;
use App\Equipment_loan;
use App\Http\Requests\ValidacionEquipmentLoan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class EquipmentLoanedController extends Controller
{
    public function index()
    {
        date_default_timezone_set('America/Guayaquil');
        $format = 'Y-m-d H:i:s';
        $now = date($format, strtotime("-30 days"));
        $to = date($format, strtotime("+30 days"));
        $constraints = [
            'from' => $now,
            'to' => $to
        ];

        $equipment = $this->conseguirEquiposPrestados($constraints);
        return view('equipos_prestamos.index', ['equipment' => $equipment, 'searchingVals' => $constraints]);
    }

    private function conseguirEquiposPrestados($constraints) 
    {
        $equipment = DB::table('equipment_loaned as ep')
        ->join('equipment as e', 'e.id', 'ep.equipment_id')
        ->join('systems', 'systems.id', '=', 'e.systems_id')
        ->join('areas', 'areas.id', '=', 'systems.areas_id')
        ->join('locations', 'areas.locations_id', '=', 'locations.id')
        ->join('locations_user', 'locations_user.locations_id', '=','locations.id')
        ->join('users', 'users.id', 'locations_user.user_id')
        ->select(
            
            'ep.name as borrowed_a',
            'ep.email as email',
            'ep.faculty as faculty',
            'ep.career as career',
            'ep.return_date as return_date',
            'ep.id as id',
            'e.id as equi_id',
            'e.image_equipment as image_equipment',
            'e.code as code',
            'e.name as name',
            'ep.lent_by',
            'ep.name as equi_prestamo_name',
            'ep.loan_date',
            'ep.loan_observation',
            'ep.observation_return',
            'ep.received_by',
            'locations.code as code_locations',
            'areas.code as code_areas',
            'systems.code as code_systems'            
            )
        ->where('locations_user.user_id', '=', auth()->id())
        ->whereNull('ep.return_date')
        ->where('loan_date', '>=', $constraints['from'])
        ->where('loan_date', '<=', $constraints['to'])
        ->get();

        return $equipment;
    }

    
    public function exportPDF(Request $request) 
    {
        $constraints = [
           'from' => $request['from'],
           'to' => date('Y-m-d H:i:s')
        ];

        $equipment = $this->conseguirEquiposPrestadosHistorial($constraints);
        $pdf = PDF::loadView('equipos_prestamos.pdf', compact('equipment'));
        return $pdf->setPaper('a4', 'landscape')->download('equipos-prestamo-list.pdf');
    }

    public function create()
    {
        $equipos_para_prestamo = DB::table('equipment as e')
        ->join('systems', 'systems.id', '=', 'e.systems_id')
        ->join('areas', 'areas.id', '=', 'systems.areas_id')
        ->join('locations', 'areas.locations_id', '=', 'locations.id')
        ->join('locations_user', 'locations_user.locations_id', '=','locations.id')
        ->join('users', 'users.id', 'locations_user.user_id')
        ->select(
            'e.id as id',
            'e.code as code',
            'e.name as name',
            'locations.name as nombre_localizacion',
            'locations.code as code_locations',
            'areas.code as code_areas',
            'systems.code as code_systems'            
            )
        ->where('locations_user.user_id', '=', auth()->id())
        ->where('e.borrowed','LIKE','NO') 
        ->where('e.in_maintenance', 'like', 'NO')
        ->get();
        return view('equipos_prestamos.create', compact('equipos_para_prestamo'));
    }

    public function store(ValidacionEquipmentLoan $request)
    {
        try{
            DB::beginTransaction();

            Equipment_loan::create([
                'lent_by' => auth()->user()->name.' '.auth()->user()->lastname,
                'name' => $request['name'],
                'faculty' => $request['faculty'],
                'career' => $request['career'],
                'email' => $request['email'],
                'loan_observation' => $request['loan_observation'],
                'observation_return' => $request['observation_return'],
                'loan_date' => date('Y-m-d H:i:s'),
                'equipment_id' => $request['equipment_id'] 
            ]);

            $cambiar_estado_a = 'SI';
                    
                DB::table('equipment')
                ->where('id',$request['equipment_id'])
                ->update([ 'borrowed' => $cambiar_estado_a ]);
            
            DB::commit();
            return redirect()->route('equiposprestamos.index')->with('flash-success', 'Prestamo registrado con exitosamente');
        }catch(\Throwable $th) {
            DB::rollBack();
            return back()->with('flash-danger', 'HUBO UN ERROR al momento de prestar el equipo.');
        }
    }

    public function edit($id)
    {
        $equipment_para_prestamo = equipment::all();
        $equipoPrestamo=Equipment_loan::findOrFail($id);
        return view('Equipment_loan.edit',compact('id','equipoPrestamo','equipment_para_prestamo'));
    }

    public function update(Request $request, $id)
    {
        $received_by = auth()->user()->name.' '.auth()->user()->lastname;
        Equipment_loan::findOrFail($id)->update($request->all());
        $cambiar_estado_a = 'NO';
        $devolver = Equipment_loan::findOrFail($id);
        $devolver_actualizar = $devolver['equipment_id'];

        DB::table('equipment')
            ->where('id',$devolver_actualizar)
            ->update([ 'borrowed' => $cambiar_estado_a ]);

        
        Equipment_loan::where('id', $id)->whereNull('return_date')->update(
            [
                'return_date' => date('Y-m-d H:i:s'),
                'received_by' => $received_by,
            ]
        );
        return back()->with('success','Equipo devuelto con exitosamente');
    }

    public function historial()
    {
        date_default_timezone_set('America/Guayaquil');
        $format = 'Y-m-d H:i:s';
        $now = date($format, strtotime("-30 days"));
        $to = date($format, strtotime("+30 days"));
        $constraints = [
            'from' => $now,
            'to' => $to
        ];

        $equipment = $this->conseguirEquiposPrestadosHistorial($constraints);
        return view('equipos_prestamos.historial', ['equipment' => $equipment, 'searchingVals' => $constraints]);        
    }

    public function searchHistorial(Request $request) 
    {
        $constraints = [
            'from' => $request['from'],
            'to' => date('Y-m-d H:i:s')
        ];

        $equipment = $this->conseguirEquiposPrestadosHistorial($constraints);
        return view('equipos_prestamos.historial', ['equipment' => $equipment, 'searchingVals' => $constraints]);
    }

    private function conseguirEquiposPrestadosHistorial($constraints) 
    {
        $equipment = DB::table('equipment_loaned as ep')
        ->join('equipment as e', 'e.id', 'ep.equipment_id')
        ->join('systems', 'systems.id', '=', 'e.systems_id')
        ->join('areas', 'areas.id', '=', 'systems.areas_id')
        ->join('locations', 'areas.locations_id', '=', 'locations.id')
        ->join('locations_user', 'locations_user.locations_id', '=','locations.id')
        ->join('users', 'users.id', 'locations_user.user_id')
        ->select(
            
            'ep.name as borrowed_a',
            'ep.email as email',
            'ep.faculty as faculty',
            'ep.career as career',
            'ep.return_date as return_date',
            'ep.id as id',
            'e.id as equi_id',
            'e.image_equipment as image_equipment',
            'e.code as code',
            'e.name as name',
            'ep.lent_by',
            'ep.name as equi_prestamo_name',
            'ep.loan_date',
            'ep.loan_observation',
            'ep.observation_return',
            'ep.received_by',
            'locations.code as code_locations',
            'areas.code as code_areas',
            'systems.code as code_systems'
            )
        ->where('locations_user.user_id', '=', auth()->id())
        ->where('loan_date', '>=', $constraints['from'])
        ->where('loan_date', '<=', $constraints['to'])
        ->get();

        return $equipment;
    }
}
