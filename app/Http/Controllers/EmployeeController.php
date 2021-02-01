<?php

namespace preventaBiox\Http\Controllers;

use Illuminate\Http\Request;

use preventaBiox\Http\Requests\EmployeeRequest;
use preventaBiox\Employee;
use preventaBiox\User;
use preventaBiox\Order;
use preventaBiox\RegisterCustomer;



class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //Validando que se el administrador
        //MIDDLEWARE
        //KERNEL
        $this->middleware('checkAdmin');
    }

    public function index()
    {
        $empleados = Employee::orderBy('id', 'DESC')->paginate(10);

        return view('employees.index', compact('empleados'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(EmployeeRequest $request)
    {
        Employee::nuevoEmpleado($request);

        return redirect(route('empleados.index'));
    }

    public function show($slug)
    {
        $empleado = Employee::where('slug', $slug)->first();

        return view('employees.show', compact('empleado'));
    }

    public function edit($slug)
    {
        $empleado = Employee::where('slug', $slug)->first();

        return view('employees.edit', compact('empleado'));
    }

    public function update(EmployeeRequest $request)
    {
        Employee::actualizarEmpleado($request);
        return redirect(route('empleados.index'));
    }

    public function destroy($slug)
    {

        $user = Employee::where('slug', $slug)->first();
        Order::where('employees_id', $user->users_id)->update(['employees_id' => null]);
        RegisterCustomer::where('employees_id', $user->users_id)->update(['employees_id' => null]);
        Employee::where('slug', $slug)->delete();
        User::find($user->users_id)->delete();
        return redirect(route('empleados.index'));
    }
}
