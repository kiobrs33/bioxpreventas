<?php

namespace preventaBiox;

use Illuminate\Database\Eloquent\Model;

//Importando DB
use Illuminate\Support\Facades\DB;

use preventaBiox\User;

 class Employee extends Model
{
    protected $table = 'employees';

    protected $fillable = [
        'nombres',
        'apellidos',
        'telefono',
        'correo',
        'slug',
        'users_id'
    ];

    public static function nuevoEmpleado($request){
        DB::transaction(function() use($request){
            $usuario = User::create([
                'name'      => 'employee',
                'email'     => $request->correo_empleado,
                'password'  => bcrypt($request->password_empleado)
            ]);
            
            //Se genera un SLUG unico y propio para el proveedor
            $slug = str_slug($request->nombres_empleado.str_random(2));

            Employee::create([
                'nombres'   => $request->nombres_empleado,
                'apellidos' => $request->apellidos_empleado,
                'telefono'  => $request->telefono_empleado,
                'correo'    => $request->correo_empleado,
                'slug'      => $slug,
                'users_id'  => $usuario->id
            ]);
        });
    }

    public static function actualizarEmpleado($request){
        DB::transaction(function() use($request){
            
            User::where('id',$request->id_empleado)
            ->update([
                'email'     => $request->correo_empleado
            ]);

            Employee::where('slug',$request->slug)
                ->update([
                'nombres'   => $request->nombres_empleado,
                'apellidos' => $request->apellidos_empleado,
                'telefono'  => $request->telefono_empleado,
                'correo'    => $request->correo_empleado
            ]);
        });
    } 
}