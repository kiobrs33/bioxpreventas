@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-3">
            <div class="alert alert-info" role="alert">
                Actualizar Bono!
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
                    <b>Nuevo Bono</b>
                </div>
                <form action="{{route('bonos.update')}}" method="POST">

                    {{ csrf_field() }}
                    <input type="hidden" value="{{$bono->id}}" name="id_bono">

                    <div class="card-body">

                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3">Titulo</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="titulo_bono" value="{{$bono->titulo}}">
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3">Descripcion</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" rows="2"
                                    name="descripcion_bono">{{$bono->descripcion}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3">Producto</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="productsId_bono">
                                    @foreach($productos as $pro)
                                    @if($pro->id == $bono->products_id)
                                    <option value="{{$pro->id}}" selected>{{$pro->nombre}}</option>
                                    @else
                                    <option value="{{$pro->id}}">{{$pro->nombre}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3">Cantidad</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="cantidad_bono"
                                    value="{{$bono->cantidad_producto}}">
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="row justify-content-md-center">
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-success btn-block" id="btn_guardarCliente">
                                    Guardar</button>
                            </div>
                            <div class="col-sm-3">
                                <a href="{{route('bonos.index')}}" class="btn btn-danger btn-block">Volver</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection