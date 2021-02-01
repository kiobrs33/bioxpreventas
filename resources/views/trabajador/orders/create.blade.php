@extends('layouts.app')

@section('content')
<div class="container">

    <!-- div que mostrara los errores de validacion del formulario -->
    @if(count($errors))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul>
            @foreach($errors->all() as $error)
            <li class="text-danger">{{$error}}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

</div>


<form action="{{route('trabajador.pedidos.store')}}" method="POST">

    {{ csrf_field() }}
    <input type="hidden" name="id_empleado_pedido" value="{{$empleado->id}}">
    <input type="hidden" name="id_cliente_pedido" id="idCliente_pedido">

    <!-- SEMIVISTA PEDIDO -->
    <div class="container-fluid" id="container-pedido">
        <div class="row justify-content-center">


            <div class="col-sm-12 col-md-10">

                <div class="card">
                    <div class="card-header text-center">
                        <b>Nuevo Pedido</b>
                    </div>

                    <div class="card-body">

                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3">Nombres Cliente</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="nombres_pedido" readonly>
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3">Apellidos Cliente</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="apellidos_pedido" readonly>
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3">Comprobante</label>
                            <div class="col-sm-6">
                                <select class="custom-select" name="comprobante_pedido">
                                    <option selected>Seleccione</option>
                                    <option value="Factura">Factura</option>
                                    <option value="Boleta">Boleta</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3">Descripcion</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" rows="3"
                                    name="descripcion_pedido">{{old('descripcion_pedido')}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3">Lugar de Entrega</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="direccion_pedido"
                                    value="{{old('direccion_pedido')}}">
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3">Fecha de Entrega</label>
                            <div class="col-sm-6">
                                <input type="date" class="form-control" name="fecha_entrega_pedido">
                            </div>
                        </div>

                        <hr>
                        <h5 align="center">Detalles del Pedido</h5>
                        <div class="table-responsive" align="center">
                            <table class="table table-striped table-sm" id="tableProductsPedido">
                                <thead style="background-color:#A78ED5;">
                                    <th>Producto</th>
                                    <th>Precio por unidad</th>
                                    <th>Unidades por Paquete</th>
                                    <th>Precio por Paquete</th>
                                    <th>Cantidad</th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>

                        <hr>

                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3">Subtotal</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="subtotal_pedido" name="impuesto_pedido"
                                    style="text-align:center;" value="0.000" readonly>
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3">Impuesto <b>18% IGV</b></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="impuesto_pedido" name="impuesto_pedido"
                                    style="text-align:center;" value="0.000" readonly>
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3">Total</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="total_pedido" name="total_pedido"
                                    style="text-align:center;" value="0.000" readonly>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group row justify-content-center">
                            <div class="col-6 col-sm-4 mb-2">
                                <button type="button" id="btn_clienteContainer"
                                    class="btn btn-secondary btn-block btn-sm">
                                    <i class="fas fa-user"></i> Cliente
                                </button>
                            </div>
                            <div class="col-6 col-sm-4 ">
                                <button type="button" id="btn_bonoContainer" class="btn btn-info btn-block btn-sm">
                                    <i class="fas fa-gift"></i> Bonos
                                </button>
                            </div>
                            <div class="col-6 col-sm-4">
                                <button type="button" class="btn btn-secondary btn-block btn-sm"
                                    id="btn_productoContainer">
                                    <i class="fas fa-box-open"></i> Producto</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row justify-content-between">
                            <div class="col-5 col-sm-4 col-md-4">
                                <a href="{{route('trabajador.pedidos.index')}}"
                                    class="btn btn-danger btn-block btn-sm"><i class="fas fa-arrow-left"></i> Volver</a>
                            </div>
                            <div class="col-5 col-sm-4 col-md-4">
                                <button type="submit" class="btn btn-success btn-block btn-sm"><i
                                        class="fas fa-save"></i> Guardar</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- SEMIVISTA PRODUCTO -->
    <div class="container" id="container-producto">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-between">
                    <div class="col-5 col-sm-3 col-md-2">
                        <button type="button" id="btn_backProductoContainer" class="btn btn-danger btn-sm btn-block"><i
                                class="fas fa-arrow-left"></i> Volver</button>
                    </div>
                    <div class="col-5 col-sm-3 col-md-2">
                        <button type="button" class="btn btn-success btn-sm btn-block" id="btn_addProducto">
                            <i class="fas fa-plus-circle"></i>
                            Agregar</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div style="height:450px; overflow-y:scroll;">
                    <div class="table-responsive">
                        <table class="table table-striped" id="tableProducts">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Precio por Unidad</th>
                                    <th>Unidades por Paquete</th>
                                    <th>Precio por Paquete</th>
                                    <th>Cantidad</th>
                                    <th width="100px" style="text-align:center">
                                        Opción
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" align="right"><b>Subtotal </b></td>
                                    <td colspan="2" align="center"><input type="text" id="subtotal_venta" readonly
                                            style="border:0px; text-align:center;" value="0.000">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" align="right"><b>Impuesto 18% IGV</b></td>
                                    <td colspan="2" align="center"><input type="text" id="impuesto_venta" readonly
                                            style="border:0px; text-align:center;" value="0.000">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" align="right"><b>Total </b></td>
                                    <td colspan="2" align="center"><input type="text" readonly
                                            style="border:0px; text-align:center;" id="total_venta" value="0.000">
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SEMIVISTA BONOS -->
    <div class="container" id="container-bono">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-between">
                    <div class="col-5 col-sm-3 col-md-2">
                        <button type="button" id="btn_backBonoContainer" class="btn btn-danger btn-sm btn-block"><i
                                class="fas fa-arrow-left"></i> Volver</button>
                    </div>
                    <div class="col-5 col-sm-3 col-md-2">
                        <button type="button" class="btn btn-success btn-sm btn-block" id="btn_addBono">
                            <i class="fas fa-plus-circle"></i>
                            Bono</button>
                    </div>
                </div>
            </div>

            <div class="container mt-2">
                <h5>Descripcion</h5>
                <div class="alert alert-primary" role="alert">
                    <p id="descripcion_bono"></p>
                </div>
            </div>
            <div class="card-body">
                <div style="height:300px; overflow-y:scroll;">
                    <div class="table-responsive">
                        <table class="table table-striped" id="tableBonuses">
                            <thead>
                                <tr>
                                    <th>Bono</th>
                                    <th>Producto Regalo</th>
                                    <th>Cant. Bonos</th>
                                    <th width="100px" style="text-align:center">
                                        Opción
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SEMIVISTA CLIENTE -->
    <div class="container" id="container-cliente">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-between">
                    <div class="col-5 col-sm-3 col-md-2 mb-2">
                        <button type="button" id="btn_backClienteContainer" class="btn btn-danger btn-sm btn-block"><i
                                class="fas fa-arrow-left"></i> Volver</button>
                    </div>
                    <div class="col-5 col-sm-3 col-md-2">
                        <button type="button" class="btn btn-success btn-sm btn-block" data-toggle="modal"
                            data-target="#modal-nuevoCliente"><i class="fas fa-plus-circle"></i> Nuevo</button>
                    </div>
                    <div class="col-12 col-sm-3 col-md-4">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm" id="inputBuscadorCliente">
                            <div class="input-group-prepend">
                                <button type="button" id="btn_buscarCliente" class="btn btn-info btn-sm btn-block"><i
                                        class="fas fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div style="height:450px; overflow-y:scroll;">
                    <div class="table-responsive">
                        <table class="table table-striped" id="tableCustomers">
                            <thead>
                                <tr>
                                    <th width="100px" style="text-align:center">
                                        ELEGIR
                                    </th>
                                    <th>Id</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Dni</th>
                                    <th>Ruc</th>
                                    <th>Telefono</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL PARA LA CREACION DE NUEVO CLIENTE -->
    <div class="modal fade" id="modal-nuevoCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <div class="container-fluid">
                        <div class="row justify-content-between">
                            <div class="col-12" align="center"><b>Nuevo Cliente</b></div>
                        </div>
                    </div>
                </div>
                <form>
                    <div class="modal-body">

                        <input type="hidden" value="{{ csrf_token() }}" id="token">

                        <div class="form-group row justify-content-center">
                            <!-- <label class="col-sm-3">Dni</label> -->
                            <label class="col-sm-3">
                                <button type="button" class="btn btn-info btn-sm" id="btn_buscar_dni">
                                    Dni <i class="fas fa-search"></i></button>
                            </label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control form-control-sm modal-inputs" id="dni_cliente">
                                <span class="text-danger validacion" id="validacion_dni">Dni es requerido !</span>
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3">Nombres</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-sm modal-inputs"
                                    id="nombres_cliente">
                                <span class="text-danger validacion" id="validacion_nombres">Nombres es requerido
                                    !</span>
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3">Apelidos</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-sm modal-inputs"
                                    id="apellidos_cliente">
                                <span class="text-danger validacion" id="validacion_apellidos">Apellidos es requerido
                                    !</span>
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            <!-- <label class="col-sm-3">Dni</label> -->
                            <label class="col-sm-3">
                                <button type="button" class="btn btn-info btn-sm" id="btn_buscar_ruc">
                                    Ruc <i class="fas fa-search"></i></button>
                            </label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control form-control-sm modal-inputs" id="ruc_cliente">
                                <span class="text-danger validacion" id="validacion_ruc">Ruc es requerido !</span>
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3 ">Empresa</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-sm modal-inputs"
                                    id="empresa_cliente">
                                <span class="text-danger validacion" id="validacion_empresa">Empresa es requerido
                                    !</span>
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3 ">Direccion</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-sm modal-inputs"
                                    id="direccion_cliente">
                                <span class="text-danger validacion" id="validacion_direccion">Direccion es requerido
                                    !</span>
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3">Telefono</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control form-control-sm modal-inputs"
                                    id="telefono_cliente">
                                <span class="text-danger validacion" id="validacion_telefono">Telefono es requerido
                                    !</span>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <div class="container-fluid">
                            <div class="row justify-content-between">
                                <div class="col-5 col-sm-3">
                                    <button type="button" class="btn btn-danger btn-sm btn-block" data-dismiss="modal">
                                        <i class="fas fa-arrow-left"></i> Volver
                                    </button>
                                </div>
                                <div class="col-5 col-sm-3">
                                    <button type="button" id="btn_guardarCliente"
                                        class="btn btn-success btn-sm btn-block">
                                        <i class="fas fa-save"></i> Guardar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
</form>

<script src="{{asset('scripts/orders.js') }}"></script>

@endsection