@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-3">
            <div class="alert alert-info" role="alert">
                Crear nuevo Empleado!.
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
                    <b>Nuevo Empleado</b>
                </div>
                <form action="{{route('empleados.store')}}" method="POST">

                    {{ csrf_field() }}

                    <div class="card-body">
                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3">Nombres</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="nombres_empleado"
                                    value="{{old('nombres_empleado')}}">
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3">Apellidos</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="apellidos_empleado"
                                    value="{{old('apellidos_empleado')}}">
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3">Telefono</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="telefono_empleado"
                                    value="{{old('telefono_empleado')}}">
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3">Correo</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="correo_empleado"
                                    value="{{old('correo_empleado')}}">
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3">Contraseña</label>
                            <div class="col-sm-6">
                                <input type="password" class="form-control" name="password_empleado">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row justify-content-md-center">
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-success btn-block">Guardar</button>
                            </div>
                            <div class="col-sm-3">
                                <a href="{{route('empleados.index')}}" class="btn btn-danger btn-block">Volver</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection