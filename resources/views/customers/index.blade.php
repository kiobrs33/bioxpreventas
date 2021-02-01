@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="row justify-content-center">
        <div class="col-sm-3">
            <div class="alert alert-info" role="alert">
                <h5>CLIENTES</h5>
            </div>
        </div>
        <div class="col-sm-7">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Dni</th>
                            <th>Telefono</th>
                            <th width="100px">
                                <a href="{{route('clientes.create')}}" class="btn btn-success btn-block">
                                    <i class="fas fa-plus-circle"></i>
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clientes as $cliente)
                        <tr>
                            <td>{{$cliente->id}}</td>
                            <td>{{$cliente->nombres}}</td>
                            <td>{{$cliente->apellidos}}</td>
                            <td>{{$cliente->dni}}</td>
                            <td>{{$cliente->telefono}}</td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                    <a href="{{route('clientes.edit',$cliente->slug)}}" class="btn btn-secondary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{route('clientes.show', $cliente->slug)}}" class="btn btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $clientes->links("pagination::bootstrap-4") }}
        </div>
    </div>

</div>

@endsection