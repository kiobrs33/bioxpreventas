<?php

namespace preventaBiox\Http\Controllers\Employee;

use Illuminate\Http\Request;

//Importando DB
use Illuminate\Support\Facades\DB;

//importando clase CONTROLLER
use preventaBiox\Http\Controllers\Controller;

use preventaBiox\Http\Requests\OrderRequest;

use preventaBiox\Order;
use preventaBiox\Customer;
use preventaBiox\Product;
use preventaBiox\Bonuse;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        //Para obtener el DEL EMPLEADO
        $dato = DB::table('users as u')
        ->join('employees as e','e.users_id','=','u.id')
        ->select('e.id')
        ->where('u.id','=',Auth()->user()->id)
        ->get();

        $busqueda = $request->get('busqueda');

        $pedidos = DB::table('orders as o')
        ->join('customers as c','o.customers_id','=','c.id')
        ->select('o.*','c.nombres as nombres_cliente')
        ->where('o.employees_id','=',$dato[0]->id)
        ->Where('c.nombres','LIKE',"%$busqueda%")
        ->orderBy('id','DESC')
        ->paginate(10);
        return view('trabajador.orders.index', compact('pedidos'));
    }

    public function create()
    {
        //Para obtener el DEL EMPLEADO
        $dato = DB::table('users as u')
        ->join('employees as e','e.users_id','=','u.id')
        ->select('e.id')
        ->where('u.id','=',Auth()->user()->id)
        ->get();

        $empleado = $dato[0];
        return view('trabajador.orders.create',compact('empleado'));
    }

    public function store(OrderRequest $request)
    {   
        
        Order::guardarPedido($request);
        return redirect(route('trabajador.pedidos.index'));
    }

    public function show($slug)
    {
        $pedido = Order::pedido($slug);
        $detallespedido = Order::detallesPedido($slug);
        $bonos = Order::bonos($slug);
        
        return view('trabajador.orders.show', compact('pedido','detallespedido','bonos'));
    }

    public function edit($slug)
    {
        $pedido = Order::where('slug',$slug)->first(); 
        return view('trabajador.orders.edit', compact('pedido'));
    }

    public function update(Request $request)
    {        
        return;
    }

    public function destroy(Request $request, $slug)
    {
        return;
    }

    //AQUI SE SE UTILIZARA FUNCIONES AJA DEL CONTROLADOR -> CUSTOMER
    //Se aplico un middleware para CustomerController
    
}