@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card text-white mb-3" style="background-color:#883988;cursor:pointer;" id="pedidos_panel">
                <div class="card-body">
                    <h4 align="center"><i class="fas fa-clipboard-list"></i> Pedidos</h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white mb-3" style="background-color:#883988;cursor:pointer;" id="productos_panel">
                <div class="card-body">
                    <h4 align="center"><i class="fas fa-box-open"></i> Productos</h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white mb-3" style="background-color:#883988;cursor:pointer;" id="trabajadores_panel">
                <div class="card-body">
                    <h4 align="center"><i class="fas fa-people-carry"></i> Trabajadores</h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white mb-3" style="background-color:#883988;cursor:pointer;" id="clientes_panel">
                <div class="card-body">
                    <h4 align="center"><i class="fas fa-user-friends"></i> Clientes</h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white mb-3" style="background-color:#883988;cursor:pointer;" id="bonos_panel">
                <div class="card-body">
                    <h4 align="center"><i class="fas fa-user-friends"></i> Bonos</h4>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $("#pedidos_panel").click(function() {
        let url = "pedidos";
        $(location).attr('href', url);
    });
    $("#productos_panel").click(function() {
        let url = "productos";
        $(location).attr('href', url);
    });
    $("#trabajadores_panel").click(function() {
        let url = "empleados";
        $(location).attr('href', url);
    });
    $("#clientes_panel").click(function() {
        let url = "clientes";
        $(location).attr('href', url);
    });
    $("#bonos_panel").click(function() {
        let url = "bonos";
        $(location).attr('href', url);
    });
</script>
@endsection