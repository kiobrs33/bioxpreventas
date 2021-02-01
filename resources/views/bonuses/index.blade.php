@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="row justify-content-center">
        <div class="col-sm-3">
            <div class="alert alert-info" role="alert">
                <h5>BONOS</h5>
            </div>
        </div>
        <div class="col-sm-7">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Titulo</th>
                            <th>Descripcion</th>
                            <th>Cantidad Gratis</th>
                            <th>Producto</th>
                            <th width="100px">
                                <a href="{{route('bonos.create')}}" class="btn btn-success btn-block">
                                    <i class="fas fa-plus-circle"></i>
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bonos as $bono)
                        <tr>
                            <td>{{$bono->id}}</td>
                            <td>{{$bono->titulo}}</td>
                            <td>{{$bono->descripcion}}</td>
                            <td>{{$bono->cantidad_producto}}</td>
                            <td>{{$bono->nombre_producto}}</td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                    <a href="{{route('bonos.edit',$bono->slug)}}" class="btn btn-secondary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{route('bonos.show', $bono->slug)}}" class="btn btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $bonos->links("pagination::bootstrap-4") }}
        </div>
    </div>

</div>

@endsection