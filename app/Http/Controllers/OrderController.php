<?php

namespace preventaBiox\Http\Controllers;

use Illuminate\Http\Request;

//Importando DB
use Illuminate\Support\Facades\DB;

use preventaBiox\Http\Requests\OrderRequest;

use preventaBiox\Order;
use preventaBiox\Customer;
use preventaBiox\Product;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //Validando que se el administrador
        //MIDDLEWARE
        //KERNEL
        //AQUI se esta aplicando el MIDDLEWARE SOLO PARA ALGUNAS FUNCIONES
        $this->middleware('checkAdmin', ['only' => ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']]);
    }

    public function index(Request $request)
    {

        $busqueda = $request->get('busqueda');

        $pedidos = Order::listaPedidos($busqueda);


        return view('orders.index', compact('pedidos'));
    }

    public function create()
    {
        //Para obtener el DEL EMPLEADO
        $dato = DB::table('users as u')
            ->join('employees as e', 'e.users_id', '=', 'u.id')
            ->select('e.id')
            ->get();

        $empleado = $dato[0];
        return view('orders.create', compact('empleado'));
    }

    public function store(OrderRequest $request)
    {
        Order::guardarPedido($request);
        return redirect(route('pedidos.index'));
    }

    public function show($slug)
    {
        $pedido = Order::pedido($slug);
        $detallespedido = Order::detallesPedido($slug);
        $bonos = Order::bonos($slug);
        $estados = ["Pedido", "Proceso", "Cancelado"];

        return view('orders.show', compact('pedido', 'detallespedido', 'bonos', 'estados'));
    }

    public function edit($slug)
    {
        $pedido = Order::where('slug', $slug)->first();
        return route('pedidos.index');
    }

    public function update(Request $request)
    {

        if ($request->nro_comprobante_pedido) {
            Order::where('slug', $request->slug_pedido)
                ->update([
                    'estado'                => $request->estado_pedido,
                    'numero_comprobante'    => $request->nro_comprobante_pedido
                ]);
        } else {
            Order::where('slug', $request->slug_pedido)
                ->update([
                    'estado'                => $request->estado_pedido,
                    'numero_comprobante'    => ""
                ]);
        }

        return redirect(route('pedidos.index'));
    }

    public function destroy(Request $slug)
    {
        return;
    }

    //Funciones para OPERACIONES AJAX
    public function listCustomers()
    {
        $clientes = [];
        $tipoUser = Auth()->user()->name;
        $idUser = Auth()->user()->id;

        if ($tipoUser == "employee") {
            $clientes = DB::table('employees as e')
                ->join('users as u', 'e.users_id', '=', 'u.id')
                ->join('registers_customers as r', 'r.employees_id', '=', 'e.id')
                ->join('customers as c', 'r.customers_id', '=', 'c.id')
                ->select('c.*')
                ->orderBy('id', 'DESC')
                ->get();

            return $clientes;
        }

        $clientes = Customer::orderBy('id', 'DESC')->get();

        return $clientes;
    }

    public function listProducts()
    {
        $productos = Product::orderBy('id', 'DESC')->get();
        return $productos;
    }

    public function createCustomer(Request $request)
    {
        if ($request->ajax()) {
            $respuesta = Customer::registrarCliente($request);

            return response()->json([
                "respuesta" => $respuesta
            ]);
        }
    }

    public function listBonuses()
    {

        $bonos = DB::table('bonuses as b')
            ->join('products as p', 'b.products_id', '=', 'p.id')
            ->select('b.*', 'p.nombre as nombre_producto')
            ->orderBy('id', 'DESC')
            ->get();

        return $bonos;
    }

    public function stateOrder(Request $request)
    {
        $pedido = Order::find($request->id_pedido);
        $pedido->estado  = $request->estado_pedido;
        $pedido->save();

        return view('orders.index');
    }
}
