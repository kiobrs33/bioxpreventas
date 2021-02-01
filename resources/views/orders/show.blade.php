@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">

        <div class="col-sm-12 col-md-12 col-xl-5">
            <h5>PRODUCTOS DEL PEDIDO</h5>
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>Producto</th>
                            <th>Unidad por Paquete</th>
                            <th>Precio Unidad</th>
                            <th>Cantidad</th>
                            <th>Precio Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($detallespedido as $dt)
                        <tr class="table-secondary">
                            <td>{{$dt->nombre}}</td>
                            <td>{{$dt->cantidad_paquete}}</td>
                            <td>S/. {{$dt->precio}}</td>
                            <td align="center">{{$dt->cantidad}}</td>
                            <td>S/. {{$dt->subtotal}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" align="right"><b>Subtotal</b></td>
                            <td>{{$pedido->total - $pedido->impuesto}}</td>
                        </tr>
                        <tr>
                            <td colspan="4" align="right"><b>Impuesto</b></td>
                            <td>{{$pedido->impuesto}}</td>
                        </tr>
                        <tr>
                            <td colspan="4" align="right"><b>Total</b></td>
                            <td>{{$pedido->total}}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <hr>
            <h5>BONOS</h5>
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bonos as $bono)
                        <tr class="table-info">
                            <td>{{$bono->nombre}}</td>
                            <td>{{$bono->cantidad_producto}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-sm-12 col-md-12 col-xl-7">

            <div class="card">
                @if($pedido->estado == "Pedido")
                <div class="card-header text-center" style="background-color:#FFD2D2;">
                    <b>INFORMACION PEDIDO</b>
                </div>
                @elseif($pedido->estado == "Proceso")
                <div class="card-header text-center" style="background-color:#FFFFA8;">
                    <b>INFORMACION PEDIDO</b>
                </div>
                @elseif($pedido->estado == "Cancelado")
                <div class="card-header text-center" style="background-color:#BFDFFF;">
                    <b>INFORMACION PEDIDO</b>
                </div>
                @endif
                <div class="card-body">

                    <form action="{{route('pedidos.update')}}" method="post">

                        {{ csrf_field() }}
                        <input type="hidden" name="slug_pedido" value="{{$pedido->slug}}">

                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3"><b>Estado</b></label>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <select class=" form-control" name="estado_pedido">
                                        @foreach($estados as $estado)
                                        @if($estado == $pedido->estado)
                                        <option value="{{$estado}}" selected>{{$estado}}</option>
                                        @else
                                        <option value="{{$estado}}">{{$estado}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    <div class="input-group-prepend">
                                        <div class="input-group">
                                            <button type="submit" class="btn btn-success">
                                                <i class="fas fa-save"></i> Guardar
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3"><b>Nro. Comprobante</b></label>
                            <div class="col-sm-6">
                                <input type="text" style="text-align:center;" class="form-control"
                                    name="nro_comprobante_pedido" value="{{$pedido->numero_comprobante}}">
                            </div>
                        </div>

                    </form>

                    <div class="form-group row justify-content-center">
                        <label class="col-sm-3">Fecha Registrada</label>
                        <div class="col-sm-6">
                            <input type="text" style="text-align:center;" class="form-control"
                                value="{{$pedido->fecha_registro}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-3">Fecha de Entrega</label>
                        <div class="col-sm-6">
                            <input type="text" style="text-align:center" class="form-control"
                                value="{{$pedido->fecha_entrega}}" readonly>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-3">Empleado</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" style="text-align:center;"
                                value="{{$pedido->nombres_empleado.' '.$pedido->apellidos_empleado}}" readonly>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-3">Contacto</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" style="text-align:center;"
                                value="{{$pedido->nombres_cliente.' '.$pedido->apellidos_cliente}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-3">Dni</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" style="text-align:center;"
                                value="{{$pedido->dni_cliente}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-3">Telefono</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" style="text-align:center;"
                                value="{{$pedido->telefono_cliente}}" readonly>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group row justify-content-center">
                        <label class="col-sm-3">Ruc</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" style="text-align:center;"
                                value="{{$pedido->ruc_cliente}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-3">Direccion Empresa</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" rows="3" readonly>{{$pedido->direccion_cliente}}</textarea>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group row justify-content-center">
                        <label class="col-sm-3">Descripcion</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" rows="3" readonly>{{$pedido->descripcion}}</textarea>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-3">Direccion Pedido</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" style="text-align:center;"
                                value="{{$pedido->direccion}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-3">Comprobante</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" style="text-align:center;"
                                value="{{$pedido->comprobante}}" readonly>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-3">Subtotal</label>
                        <div class="col-sm-6">
                            <input type="number" step="any" class="form-control" style="text-align:center;"
                                value="{{$pedido->total - $pedido->impuesto}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-3">Impuesto</label>
                        <div class="col-sm-6">
                            <input type="number" step="any" class="form-control" style="text-align:center;"
                                value="{{$pedido->impuesto}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-3">Total</label>
                        <div class="col-sm-6">
                            <input type="number" step="any" class="form-control" style="text-align:center;"
                                value="{{$pedido->total}}" readonly>
                        </div>
                    </div>

                </div>
                <div class="card-footer mb-3">
                    <div class="row justify-content-md-center">
                        <div class="col-sm-3">
                            <a href="{{route('pedidos.index')}}" class="btn btn-danger btn-block">Volver</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection