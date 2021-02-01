@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-3">
            <div class="alert alert-info" role="alert">
                Lista de todos los Clientes registrados!.
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
                    <b>Nuevo Cliente</b>
                </div>
                <form action="{{route('trabajador.clientes.store')}}" method="POST">

                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3">
                                <button type="button" class="btn btn-info btn-sm" id="btn_buscar_dni">
                                    Dni <i class="fas fa-search"></i>
                                </button>
                            </label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="dni_cliente" id="dni_cliente"
                                    placeholder="Opcional">
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3">Nombres</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="nombres_cliente" id="nombres_cliente"
                                    placeholder="Opcional">
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3">Apelidos</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="apellidos_cliente" id="apellidos_cliente"
                                    placeholder="Opcional">
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3">Telefono</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="telefono_cliente"
                                    placeholder="Opcional">
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3">
                                <button type="button" class="btn btn-info btn-sm" id="btn_buscar_ruc"
                                    placeholder="Opcional">
                                    Ruc <i class="fas fa-search"></i></button>
                            </label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="ruc_cliente" id="ruc_cliente"
                                    placeholder="Opcional">
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3">Empresa</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="empresa_cliente" id="empresa_cliente"
                                    placeholder="Opcional">
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3 ">Direccion</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="direccion_cliente" id="direccion_cliente"
                                    placeholder="Opcional">
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
                                <a href="{{route('trabajador.clientes.index')}}"
                                    class="btn btn-danger btn-block">Volver</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
$("#btn_buscar_dni").click(function() {
    var dni = $("#dni_cliente").val();
    if (dni.length == 8) {
        var URL =
            "https://dniruc.apisperu.com/api/v1/dni/" +
            dni +
            "?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6InJlbmUubG96YW5vQHRlY3N1cC5lZHUucGUifQ.zaHm2Ff1axozxsNA1LT1H4ZSrR-FSxnmCmWcFBk-a3E";

        $("#nombres_cliente").val("Buscando ..");
        $("#apellidos_cliente").val("Buscando ..");

        $.ajax({
            type: "GET",
            url: URL,
            success: function(data) {
                $("#nombres_cliente").val(data.nombres);
                $("#apellidos_cliente").val(
                    data.apellidoPaterno + " " + data.apellidoMaterno
                );
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("Error Ajax");
            }
        });
    }
});

$("#btn_buscar_ruc").click(function() {
    var ruc = $("#ruc_cliente").val();
    if (ruc.length == 11) {
        var URL =
            "https://dniruc.apisperu.com/api/v1/ruc/" +
            ruc +
            "?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6InJlbmUubG96YW5vQHRlY3N1cC5lZHUucGUifQ.zaHm2Ff1axozxsNA1LT1H4ZSrR-FSxnmCmWcFBk-a3E";

        $("#empresa_cliente").val("buscando ...");
        $("#direccion_cliente").val("buscando ...");

        $.ajax({
            type: "GET",
            url: URL,
            success: function(data) {
                $("#empresa_cliente").val(data.razonSocial);
                $("#direccion_cliente").val(data.direccion);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("Error Ajax");
            }
        });
    }
});
</script>
@endsection