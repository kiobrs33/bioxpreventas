<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('clientes')->group(function () {
    Route::get('/', 'CustomerController@index')->name('clientes.index');
    Route::get('create', 'CustomerController@create')->name('clientes.create');
    Route::post('store', 'CustomerController@store')->name('clientes.store');
    Route::get('show/{slug}', 'CustomerController@show')->name('clientes.show');
    Route::get('editar/{slug}', 'CustomerController@edit')->name('clientes.edit');
    Route::post('update', 'CustomerController@update')->name('clientes.update');
    Route::post('destroy/{slug}', 'CustomerController@index')->name('clientes.destroy');
});

Route::prefix('productos')->group(function () {
    Route::get('/', 'ProductController@index')->name('productos.index');
    Route::get('create', 'ProductController@create')->name('productos.create');
    Route::post('store', 'ProductController@store')->name('productos.store');
    Route::get('show/{slug}', 'ProductController@show')->name('productos.show');
    Route::get('editar/{slug}', 'ProductController@edit')->name('productos.edit');
    Route::post('update', 'ProductController@update')->name('productos.update');
    Route::post('destroy/{slug}', 'ProductController@index')->name('productos.destroy');
});

Route::prefix('empleados')->group(function () {
    Route::get('/', 'EmployeeController@index')->name('empleados.index');
    Route::get('create', 'EmployeeController@create')->name('empleados.create');
    Route::post('store', 'EmployeeController@store')->name('empleados.store');
    Route::get('show/{slug}', 'EmployeeController@show')->name('empleados.show');
    Route::get('editar/{slug}', 'EmployeeController@edit')->name('empleados.edit');
    Route::post('update', 'EmployeeController@update')->name('empleados.update');
    Route::get('destroy/{slug}', 'EmployeeController@destroy')->name('empleados.destroy');
});

Route::prefix('pedidos')->group(function () {
    Route::get('/', 'OrderController@index')->name('pedidos.index');
    Route::get('create', 'OrderController@create')->name('pedidos.create');
    Route::post('store', 'OrderController@store')->name('pedidos.store');
    Route::get('show/{slug}', 'OrderController@show')->name('pedidos.show');
    Route::get('editar/{slug}', 'OrderController@edit')->name('pedidos.edit');
    Route::post('update', 'OrderController@update')->name('pedidos.update');
    Route::post('destroy/{slug}', 'OrderController@index')->name('pedidos.destroy');

    Route::get('/listCustomers', 'OrderController@listCustomers');
    Route::post('/createCustomer', 'OrderController@createCustomer');
    Route::get('/listProducts', 'OrderController@listProducts');
    Route::get('/listBonuses', 'OrderController@listBonuses');
});

Route::prefix('bonos')->group(function () {
    Route::get('/', 'BonuseController@index')->name('bonos.index');
    Route::get('create', 'BonuseController@create')->name('bonos.create');
    Route::post('store', 'BonuseController@store')->name('bonos.store');
    Route::get('show/{slug}', 'BonuseController@show')->name('bonos.show');
    Route::get('editar/{slug}', 'BonuseController@edit')->name('bonos.edit');
    Route::post('update', 'BonuseController@update')->name('bonos.update');
    Route::post('destroy/{slug}', 'BonuseController@index')->name('bonos.destroy');
});

//RUTAS PARA EL TRABAJADOR
Route::prefix('trabajador')->group(function () {

    Route::get('/home', 'Employee\HomeController@index')->name('trabajador.home');

    Route::prefix('clientes')->group(function () {
        Route::get('/', 'Employee\CustomerController@index')->name('trabajador.clientes.index');
        Route::get('create', 'Employee\CustomerController@create')->name('trabajador.clientes.create');
        Route::post('store', 'Employee\CustomerController@store')->name('trabajador.clientes.store');
        Route::get('show/{slug}', 'Employee\CustomerController@show')->name('trabajador.clientes.show');
        Route::get('editar/{slug}', 'Employee\CustomerController@edit')->name('trabajador.clientes.edit');
        Route::post('update', 'Employee\CustomerController@update')->name('trabajador.clientes.update');
    });

    Route::prefix('productos')->group(function () {
        Route::get('/', 'Employee\ProductController@index')->name('trabajador.productos.index');
        Route::get('show/{slug}', 'Employee\ProductController@show')->name('trabajador.productos.show');
    });

    Route::prefix('empleados')->group(function () {
        Route::get('show', 'Employee\EmployeeController@show')->name('trabajador.empleados.show');
    });

    Route::prefix('pedidos')->group(function () {
        Route::get('/', 'Employee\OrderController@index')->name('trabajador.pedidos.index');
        Route::get('create', 'Employee\OrderController@create')->name('trabajador.pedidos.create');
        Route::post('store', 'Employee\OrderController@store')->name('trabajador.pedidos.store');
        Route::get('show/{slug}', 'Employee\OrderController@show')->name('trabajador.pedidos.show');
        Route::get('editar/{slug}', 'Employee\OrderController@edit')->name('trabajador.pedidos.edit');
        Route::post('update', 'Employee\OrderController@update')->name('trabajador.pedidos.update');
    });
});
