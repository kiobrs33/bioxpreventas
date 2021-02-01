@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-3">
            <div class="alert alert-info" role="alert">
                Crear Bono!
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
                <form action="{{route('bonos.store')}}" method="POST">

                    {{ csrf_field() }}
                    <div class="card-body">

                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3">Titulo</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="titulo_bono">
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3">Descripcion</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" rows="2" name="descripcion_bono"></textarea>
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3">Producto</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="productsId_bono">
                                    @foreach($productos as $pro)
                                    <option value="{{$pro->id}}">{{$pro->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3">Cantidad</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="cantidad_bono">
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