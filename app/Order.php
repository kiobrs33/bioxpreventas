<?php

namespace preventaBiox;

use Illuminate\Database\Eloquent\Model;

//Importando DB
use Illuminate\Support\Facades\DB;

//Para la fecha
use Carbon\carbon;

use preventaBiox\DetailsOrder;
use preventaBiox\OrdersBonuses;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'descripcion',
        'direccion',
        'comprobante',
        'total',
        'impuesto',
        'estado',
        'numero_comprobante',
        'fecha_registro',
        'fecha_entrega',
        'slug',
        'employees_id',
        'customers_id'
    ];

    public static function guardarPedido($request)
    {

        DB::transaction(function () use ($request) {
            $pedido = Order::create([
                'descripcion'       => $request->descripcion_pedido,
                'direccion'         => $request->direccion_pedido,
                'comprobante'       => $request->comprobante_pedido,
                'total'             => (float) $request->total_pedido,
                'impuesto'          => (float) $request->impuesto_pedido,
                'numero_comprobante' => "",
                'estado'            => "Pedido",
                'fecha_registro'    => new Carbon(),
                'fecha_entrega'     => $request->fecha_entrega_pedido,
                'slug'              => str_random(6),
                'employees_id'      => (int) $request->id_empleado_pedido,
                'customers_id'      => (int) $request->id_cliente_pedido
            ]);


            if ($request->id_producto_pedido > 0) {
                //Aqui obteneos la POSICION DE cada de ELEMENTO $POSTION
                foreach ($request->id_producto_pedido as $position => $valor) {
                    DetailsOrder::create([
                        'cantidad'      => (int) $request->cantidad_producto_pedido[$position],
                        'subtotal'      => (float) $request->subtotal_producto_pedido[$position],
                        'products_id'   => (int) $request->id_producto_pedido[$position],
                        'orders_id'     => (int) $pedido->id
                    ]);
                }
            }

            if ($request->id_producto_bono_pedido > 0) {
                //Aqui obteneos la POSICION DE cada de ELEMENTO $POSTION
                foreach ($request->id_producto_bono_pedido as $position => $valor) {
                    OrdersBonuses::create([
                        'cantidad_producto' => $request->cantidad_bono_pedido[$position],
                        'orders_id'         => (int) $pedido->id,
                        'bonuses_id'        => (int) $request->id_bono_pedido[$position],
                        'products_id'       => (int) $request->id_producto_bono_pedido[$position]
                    ]);
                }
            }
        });
    }

    public static function pedido($slug)
    {
        $dato = DB::table('orders as o')
            ->join('employees as e', 'o.employees_id', '=', 'e.id')
            ->join('customers as c', 'o.customers_id', '=', 'c.id')
            ->select(
                'o.*',
                'e.nombres as nombres_empleado',
                'e.apellidos as apellidos_empleado',
                'c.nombres as nombres_cliente',
                'c.apellidos as apellidos_cliente',
                'c.dni as dni_cliente',
                'c.ruc as ruc_cliente',
                'c.empresa as empresa_cliente',
                'c.direccion_empresa as direccion_cliente',
                'c.telefono as telefono_cliente'
            )
            ->where('o.slug', '=', $slug)
            ->get();

        return $dato[0];
    }

    public static function detallesPedido($slug)
    {
        $dato = DB::table('orders as o')
            ->join('details_orders as d', 'd.orders_id', '=', 'o.id')
            ->join('products as p', 'd.products_id', '=', 'p.id')
            ->select('d.id as id_detalle', 'd.cantidad', 'd.subtotal', 'p.nombre', 'p.cantidad_paquete', 'p.precio', 'd.subtotal')
            ->where('o.slug', '=', $slug)
            ->get();

        return $dato;
    }

    public static function bonos($slug)
    {
        $dato = DB::table('orders as o')
            ->join('orders_bonuses as ob', 'o.id', '=', 'ob.orders_id')
            ->join('products as p', 'ob.products_id', '=', 'p.id')
            ->select('ob.id', 'p.nombre', 'ob.cantidad_producto')
            ->where('o.slug', '=', $slug)
            ->get();

        return $dato;
    }

    public static function listaPedidos($busqueda)
    {
        $pedidos = DB::table('orders as o')
            ->join('employees as e', 'o.employees_id', '=', 'e.id')
            ->join('customers as c', 'o.customers_id', '=', 'c.id')
            ->select('o.*', 'e.nombres as nombre_empleado', 'c.nombres as nombre_cliente')
            ->where('c.nombres', 'LIKE', "%$busqueda%")
            ->orWhere('e.nombres', 'LIKE', "%$busqueda%")
            ->orWhere('o.total', 'LIKE', "%$busqueda%")
            ->orderBy('id', 'DESC')
            ->paginate(10);

        return $pedidos;
    }

    public static function ordersAdmin()
    {

        $orders = DB::table('orders as o')
            ->join('employees as e', 'o.employees_id', '=', 'e.id')
            ->join('customers as c', 'o.customers_id', '=', 'c.id')
            ->select(
                'o.id',
                'e.nombres as nombres_trabajador',
                'e.apellidos as apellidos_trabajador',
                'o.comprobante',
                'o.estado',
                'o.numero_comprobante',
                'o.slug',
            );

        return $orders;
    }
}
