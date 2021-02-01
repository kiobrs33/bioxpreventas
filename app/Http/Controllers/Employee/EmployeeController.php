<?php

namespace preventaBiox\Http\Controllers\Employee;

use Illuminate\Http\Request;

//importando clase CONTROLLER
use preventaBiox\Http\Controllers\Controller;
//Importando DB
use Illuminate\Support\Facades\DB;

use preventaBiox\Employee;


class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function show()
    {
        $dato = DB::table('users as u')
        ->join('employees as e','e.users_id','=','u.id')
        ->select('e.*')
        ->where('u.id','=', Auth()->user()->id)
        ->get();
        $empleado = $dato[0];
        
        return view('trabajador.employees.show', compact('empleado'));
    }

}