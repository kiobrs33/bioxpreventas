<?php

namespace preventaBiox;

use Illuminate\Database\Eloquent\Model;

class RegisterCustomer extends Model
{
    protected $table = 'registers_customers';

    protected $fillable = [
        'fecha',
        'slug',
        'employees_id',
        'customers_id'
    ];
}