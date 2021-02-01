<?php

namespace preventaBiox;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'nombre',
        'descripcion',
        'cantidad_paquete',
        'precio',
        'slug'
    ];
}