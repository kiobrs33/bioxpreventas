@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-3">
            <div class="alert alert-info" role="alert">
                Ver producto!.
            </div>
        </div>

        <div class="col-sm-6">

            <div class="card">
                <div class="card-header text-center">
                    <b>Producto</b>
                </div>
                <div class="card-body">
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-3">Nombre</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" value="{{$producto->nombre}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-3">Cant. Paquete</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" value="{{$producto->cantidad_paquete}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-3">Descripcion</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" rows="3" readonly>{{$producto->descripcion}}</textarea>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-3">Precio Unidad</label>
                        <div class="col-sm-6">
                            <input type="number" step="any" class="form-control" value="{{$producto->precio}}" readonly>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row justify-content-md-center">
                        <div class="col-sm-3">
                            <a href="{{route('trabajador.productos.index')}}"
                                class="btn btn-danger btn-block">Volver</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection