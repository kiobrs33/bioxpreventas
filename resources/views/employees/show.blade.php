@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-3">
            <div class="alert alert-info" role="alert">
                Ver empleado!.
            </div>
        </div>

        <div class="col-sm-6">

            <div class="card">
                <div class="card-header text-center">
                    <b>Ver Empleado</b>
                </div>
                <form>

                    <div class="card-body">
                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3">Nombres</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="nombres_empleado"
                                    value="{{$empleado->nombres}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3">Apellidos</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="apellidos_empleado"
                                    value="{{$empleado->apellidos}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3">Telefono</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="telefono_empleado"
                                    value="{{$empleado->telefono}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3">Correo</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="correo_empleado"
                                    value="{{$empleado->correo}}" readonly>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="row justify-content-md-center">
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