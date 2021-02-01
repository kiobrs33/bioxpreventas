<?php

namespace preventaBiox;

use Illuminate\Database\Eloquent\Model;

class OrdersBonuses extends Model
{
    protected $table = 'orders_bonuses';

    protected $fillable = [
        'cantidad_producto',
        'orders_id',
        'bonuses_id',
        'products_id'
    ];
}