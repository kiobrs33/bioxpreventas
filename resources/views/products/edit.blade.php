@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-3">
            <div class="alert alert-info" role="alert">
                Editar producto!.
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
                    <b>Editar Producto</b>
                </div>
                <form action="{{route('productos.update')}}" method="POST">

                    {{ csrf_field() }}

                    <input type="hidden" value="{{$producto->id}}" name="id_producto">

                    <div class="card-body">
                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3">Nombre</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="nombre_producto"
                                    value="{{$producto->nombre}}">
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3">Cant. Paquete</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="cant_paquete_producto"
                                    value="{{$producto->cantidad_paquete}}">
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3">Descripcion</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" rows="3"
                                    name="descripcion_producto">{{$producto->descripcion}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3">Precio Unidad</label>
                            <div class="col-sm-6">
                                <input type="number" step="any" class="form-control" name="precio_producto"
                                    value="{{$producto->precio}}">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row justify-content-md-center">
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-success btn-block">Guardar</button>
                            </div>
                            <div class="col-sm-3">
                                <a href="{{route('productos.index')}}" class="btn btn-danger btn-block">Volver</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection