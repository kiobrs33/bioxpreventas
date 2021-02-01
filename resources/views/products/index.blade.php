@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="row justify-content-center">
        <div class="col-sm-3">
            <div class="alert alert-info" role="alert">
                <h5>PRODUCTOS</h5>
            </div>
        </div>
        <div class="col-sm-7">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Cant. Paquete</th>
                            <th>Precio</th>
                            <th width="100px">
                                <a href="{{route('productos.create')}}" class="btn btn-success btn-block">
                                    <i class="fas fa-plus-circle"></i>
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($productos as $producto)
                        <tr>
                            <td>{{$producto->id}}</td>
                            <td>{{$producto->nombre}}</td>
                            <td>{{$producto->descripcion}}</td>
                            <td>{{$producto->cantidad_paquete}}</td>
                            <td>{{$producto->precio}}</td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                    <a href="{{route('productos.edit',$producto->slug)}}" class="btn btn-secondary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{route('productos.show',$producto->slug)}}" class="btn btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $productos->links("pagination::bootstrap-4") }}
        </div>
    </div>

</div>

@endsection