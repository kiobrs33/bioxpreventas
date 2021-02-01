@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm" id="orders">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Trabajador nombre</th>
                                <th>Trabajador apellidos</th>
                                <th>Comprobante</th>
                                <th>Estado</th>
                                <th>Numero Comprobante</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#orders').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "{{url('api/admin/orders')}}",
            "columns": [{
                    data: 'id',
                    name: 'o.id'
                },
                {
                    data: 'nombres_trabajador',
                    name: 'e.nombres',

                },
                {
                    data: 'apellidos_trabajador',
                    name: 'e.apellidos'

                },
                {
                    data: 'comprobante',
                    name: 'o.comprobante'

                },
                {
                    data: 'estado',
                    name: 'o.estado'

                },
                {
                    data: 'numero_comprobante',
                    name: 'o.numero_comprobante'
                },
                {
                    data: 'slug',
                    name: 'o.slug'
                }
            ],
            // Traduciendo todas las ETIQUETAS DE LA TABLA EN ESPAÑOL
            "language": {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando <b>_END_</b> registros de un total de <b>_TOTAL_</b> registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "<b>Buscar:</b>",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "<i class='fa fa-angle-right'></i>",
                    "sPrevious": "<i class='fa fa-angle-left'></i>"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            },
            "responsive": true
        });
    });
</script>

@endsection