<?php

namespace preventaBiox;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Bonuse extends Model
{
    protected $table = 'bonuses';

    protected $fillable = [
        'titulo',
        'descripcion',
        'cantidad_producto',
        'products_id',
        'slug'
    ];

    public static function bonos(){
        $datos = DB::table('bonuses as b')
        ->join('products as p','p.id','=','b.products_id')
        ->select('b.id','b.titulo','b.descripcion','b.cantidad_producto','p.nombre as nombre_producto','b.slug')
        ->orderBy('id','DESC')
        ->paginate(12);
        return $datos;
    }

    public static function bono($slug){
        $dato = DB::table('bonuses as b')
        ->join('products as p','p.id','=','b.products_id')
        ->select('b.id','b.titulo','b.descripcion','b.cantidad_producto','p.nombre as nombre_producto','b.products_id')
        ->where('b.slug','=',$slug)
        ->get();

        return $dato[0];
    }
}