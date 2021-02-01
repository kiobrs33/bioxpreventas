<?php

namespace preventaBiox;

use Illuminate\Database\Eloquent\Model;

class DetailsOrder extends Model
{
    protected $table = 'details_orders';

    protected $fillable = [
        'cantidad',
        'subtotal',
        'products_id',
        'orders_id'
    ];
}