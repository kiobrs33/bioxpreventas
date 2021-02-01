@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="row justify-content-center">

        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="container-fluid">
                        <div class="row justify-content-between">
                            <div class="col-md-4">
                                <h4 align="center">Pedidos</h4>
                            </div>
                            <!--Input de BUSQUEDA -->
                            <div class="col-md-4">
                                <form action="{{route('trabajador.pedidos.index')}}" method="GET">
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm"
                                            id="inlineFormInputGroup" name="busqueda" placeholder="Ingrese..">

                                        <div class="input-group-prepend">
                                            <div class="input-group">
                                                <button type="submit" class="btn btn-info btn-sm">
                                                    <i class="fas fa-search"></i> Buscar</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Direccion</th>
                                    <th>Cliente</th>
                                    <th>Comprobante</th>
                                    <th>Estado</th>
                                    <th>Fecha Registro</th>
                                    <th width="100px">
                                        <a href="{{route('trabajador.pedidos.create')}}"
                                            class="btn btn-success btn-block">
                                            <i class="fas fa-plus-circle"></i>
                                        </a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pedidos as $pedido)

                                @if($pedido->estado == "Pedido")
                                <tr>
                                    <td>{{$pedido->id}}</td>
                                    <td>{{$pedido->direccion}}</td>
                                    <td>{{$pedido->nombres_cliente}}</td>
                                    <td><b>{{$pedido->comprobante}}</b></td>
                                    <td style="background-color:#FFD2D2;" align="center"><b>{{$pedido->estado}}</b></td>
                                    <td>{{$pedido->fecha_registro}}</td>
                                    <td align="center">
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                            <a href="{{route('trabajador.pedidos.show',$pedido->slug)}}"
                                                class="btn btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @elseif($pedido->estado == "Proceso")
                                <tr>
                                    <td>{{$pedido->id}}</td>
                                    <td>{{$pedido->direccion}}</td>
                                    <td>{{$pedido->nombres_cliente}}</td>
                                    <td><b>{{$pedido->comprobante}}</b></td>
                                    <td style="background-color:#FFFFA8;" align="center"><b>{{$pedido->estado}}</b></td>
                                    <td>{{$pedido->fecha_registro}}</td>
                                    <td align="center">
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                            <a href="{{route('trabajador.pedidos.show',$pedido->slug)}}"
                                                class="btn btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @elseif($pedido->estado == "Cancelado")
                                <tr>
                                    <td>{{$pedido->id}}</td>
                                    <td>{{$pedido->direccion}}</td>
                                    <td>{{$pedido->nombres_cliente}}</td>
                                    <td><b>{{$pedido->comprobante}}</b></td>
                                    <td style="background-color:#BFDFFF;" align="center"><b>{{$pedido->estado}}</b></td>
                                    <td>{{$pedido->fecha_registro}}</td>
                                    <td align="center">
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                            <a href="{{route('trabajador.pedidos.show',$pedido->slug)}}"
                                                class="btn btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $pedidos->links("pagination::bootstrap-4") }}
                </div>
            </div>
        </div>

    </div>
</div>

@endsection