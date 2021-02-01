@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-3">
            <div class="alert alert-info" role="alert">
                Lista de todos los Clientes registrados!.
            </div>

            <!-- div que mostrara los errores de validacion del formulario -->
            @if(count($errors))
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                    <li class="text-danger">{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif

        </div>

        <div class="col-sm-6">

            <div class="card">
                <div class="card-header text-center">
                    <b>Editar Cliente</b>
                </div>
                <form action="{{route('clientes.update')}}" method="POST">

                    {{ csrf_field() }}

                    <input type="hidden" name="id_cliente" value="{{$cliente->id}}">

                    <div class="card-body">

                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3">Nombres</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="nombres_cliente"
                                    value="{{$cliente->nombres}}">
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3">Apellidos</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="apellidos_cliente"
                                    value="{{$cliente->apellidos}}">
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3">Dni</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="dni_cliente" value="{{$cliente->dni}}">
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3">Telefono</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="telefono_cliente"
                                    value="{{$cliente->telefono}}">
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3">Ruc</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="ruc_cliente" value="{{$cliente->ruc}}">
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3">Empresa</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="empresa_cliente"
                                    value="{{$cliente->empresa}}">
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3 ">Direccion Empresa</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="direccion_empresa_cliente"
                                    value="{{$cliente->direccion_empresa}}">
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3 ">Direccion Pedido</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="direccion_pedido_cliente"
                                    value="{{$cliente->direccion_pedido}}">
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="row justify-content-md-center">
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-success btn-block">Guardar</button>
                            </div>
                            <div class="col-sm-3">
                                <a href="{{route('clientes.index')}}" class="btn btn-danger btn-block">Volver</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection