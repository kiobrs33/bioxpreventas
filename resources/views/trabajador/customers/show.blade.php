@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-3">
            <div class="alert alert-info" role="alert">
                Lista de todos los Clientes registrados!.
            </div>
        </div>

        <div class="col-sm-6">

            <div class="card">
                <div class="card-header text-center">
                    <b>Nuevo Cliente</b>
                </div>
                <div class="card-body">

                    <div class="form-group row justify-content-center">
                        <label class="col-sm-3">Nombres</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" value="{{$cliente->nombres}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-3">Apelidos</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" value="{{$cliente->apellidos}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-3">Dni</label>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" value="{{$cliente->dni}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-3">Telefono</label>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" value="{{$cliente->telefono}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-3">Ruc</label>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" value="{{$cliente->ruc}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-3">Empresa</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" value="{{$cliente->empresa}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-3 ">Direccion</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" value="{{$cliente->direccion}}" readonly>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="row justify-content-md-center">
                        <div class="col-sm-3">
                            <a href="{{route('trabajador.clientes.index')}}" class="btn btn-danger btn-block">Volver</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection