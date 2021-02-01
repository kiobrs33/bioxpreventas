@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="row justify-content-center">
        <div class="col-sm-3">
            <div class="alert alert-info" role="alert">
                <h5>VENDEDORES</h5>
            </div>
        </div>
        <div class="col-sm-7">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Telefono</th>
                            <th width="100px">
                                <a href="{{route('empleados.create')}}" class="btn btn-success btn-block">
                                    <i class="fas fa-plus-circle"></i>
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($empleados as $empleado)
                        <tr>
                            <td>{{$empleado->id}}</td>
                            <td>{{$empleado->nombres}}</td>
                            <td>{{$empleado->apellidos}}</td>
                            <td>{{$empleado->telefono}}</td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                    <a href="{{route('empleados.show',$empleado->slug)}}" class="btn btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{route('empleados.edit',$empleado->slug)}}" class="btn btn-secondary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{route('empleados.destroy',$empleado->slug)}}" class="btn btn-danger">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $empleados->links("pagination::bootstrap-4") }}
        </div>
    </div>

</div>

@endsection