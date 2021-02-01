<?php

namespace preventaBiox;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;
//Para la fecha
use Carbon\carbon;

use preventaBiox\Employee;
use preventaBiox\RegisterCustomer;

class Customer extends Model
{
    protected $table = 'customers';

    protected $fillable = [
        'nombres',
        'apellidos',
        'dni',
        'ruc',
        'empresa',
        'direccion_empresa',
        'telefono',
        'direccion_pedido',
        'slug'
    ];


    public static function listaCliente()
    {
        $datos = DB::table('customers as c')
            ->join('registers_customers as r', 'r.customers_id', '=', 'c.id')
            ->join('employees as e', 'r.employees_id', '=', 'e.id')
            ->select('c.*')
            ->orderBy('id', 'DESC')
            ->paginate(12);

        return $datos;
    }

    public static function registrarCliente($request)
    {


        DB::transaction(function () use ($request) {

            $idUser = Auth()->user()->id;

            $idTrabajador = Employee::where('users_id', $idUser)->value('id');

            //Se genera un SLUG unico y propio para el proveedor
            $slug = str_slug(str_random(6));

            $nombres            = ($request->nombres_cliente) ? $request->nombres_cliente : "Anonimo";
            $apellidos          = ($request->apellidos_cliente) ? $request->apellidos_cliente : "Anonimo";
            $dni                = ($request->dni_cliente) ? $request->dni_cliente : "00000000";
            $ruc                = ($request->ruc_cliente) ? $request->ruc_cliente : "00000000000";
            $empresa            = ($request->empresa_cliente) ? $request->empresa_cliente : "Anonimo";
            $direccion_empresa  = ($request->direccion_empresa_cliente) ? $request->direccion_empresa_cliente : "Anonimo";
            $telefono           = ($request->telefono_cliente) ? $request->telefono_cliente : "000000000";
            $direccion_pedido   = ($request->direccion_pedido_cliente) ? $request->direccion_pedido_cliente : "Anonimo";

            $cliente = Customer::create([
                'nombres'           => $nombres,
                'apellidos'         => $apellidos,
                'dni'               => $dni,
                'ruc'               => $ruc,
                'empresa'           => $empresa,
                'direccion_empresa' => $direccion_empresa,
                'telefono'          => $telefono,
                'direccion_pedido'  => $direccion_pedido,
                'slug'              => $slug
            ]);

            RegisterCustomer::create([
                'fecha'         =>  new Carbon(),
                'slug'          => str_random(6),
                'employees_id'  => $idTrabajador,
                'customers_id'  => $cliente->id
            ]);

            return "OK";
        });
    }
}
