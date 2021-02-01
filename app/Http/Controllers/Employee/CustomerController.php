<?php

namespace preventaBiox\Http\Controllers\Employee;

use Illuminate\Http\Request;

//importando clase CONTROLLER
use preventaBiox\Http\Controllers\Controller;

//Importando DB
use Illuminate\Support\Facades\DB;

use preventaBiox\Http\Requests\CustomerRequest;

use preventaBiox\Customer;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $idUser = Auth()->user()->id;
        $dato = DB::table('employees')->where('users_id', '=', $idUser)->get();

        $clientes = Customer::listaCliente();
        return view('trabajador.customers.index', compact('clientes'));
    }

    public function create()
    {
        return view('trabajador.customers.create');
    }

    public function store(CustomerRequest $request)
    {
        Customer::registrarCliente($request);

        return redirect(route('trabajador.clientes.index'));
    }

    public function show($slug)
    {
        $cliente = Customer::where('slug', $slug)->first();

        return view('trabajador.customers.show', compact('cliente'));
    }

    public function edit($slug)
    {
        $cliente = Customer::where('slug', $slug)->first();

        return view('trabajador.customers.edit', compact('cliente'));
    }

    public function update(CustomerRequest $request)
    {
        $cliente = Customer::find($request->id_cliente);
        $cliente->nombres   = $request->nombres_cliente;
        $cliente->apellidos = $request->apellidos_cliente;
        $cliente->dni       = $request->dni_cliente;
        $cliente->telefono  = $request->telefono_cliente;
        $cliente->ruc       = $request->ruc_cliente;
        $cliente->empresa   = $request->empresa_cliente;
        $cliente->direccion = $request->direccion_cliente;
        $cliente->save();

        return redirect(route('trabajador.clientes.index'));
    }

    public function destroy(Request $request, $slug)
    {
        return;
    }
}
