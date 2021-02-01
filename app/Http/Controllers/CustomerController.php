<?php

namespace preventaBiox\Http\Controllers;

use Illuminate\Http\Request;

use preventaBiox\Http\Requests\CustomerRequest;

use preventaBiox\Customer;

class CustomerController extends Controller
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
        $clientes = Customer::orderBy('id','DESC')->paginate(10);

        return view('customers.index', compact('clientes'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(CustomerRequest $request)
    {       
        Customer::registrarCliente($request);

        return redirect(route('clientes.index'));
    }

    public function show($slug)
    {
        $cliente = Customer::where('slug',$slug)->first();
        
        return view('customers.show', compact('cliente'));
    }

    public function edit($slug)
    {
        $cliente = Customer::where('slug',$slug)->first(); 
        
        return view('customers.edit', compact('cliente'));
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
        $cliente->direccion_empresa = $request->direccion_empresa_cliente;
        $cliente->direccion_pedido  = $request->direccion_pedido_cliente;
        $cliente->save();

        return redirect(route('clientes.index'));
    }

    public function destroy(Request $request, $slug)
    {
        return;
    }
}