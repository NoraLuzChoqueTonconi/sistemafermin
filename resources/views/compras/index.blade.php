@php
    use Illuminate\Support\Facades\Session;
@endphp

@extends('layouts.admin')

@section('content')
<div class="content" style="margin-left: 20px">
    <h1>Listado de Compras</h1>

    @if ($message = Session::get('mensaje'))
        <script>
            Swal.fire({
                title: "¡Buen trabajo!",
                text: "{{ $message }}",
                icon: "success"
            });
        </script>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"><b>Listado de Compras</b></h3>
                    <div class="card-tools">
                        <a href="{{ route('compras.create') }}" class="btn btn-primary">
                            <i class="bi bi-file-plus"></i> Agregar Nueva Compra
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped table-sm">
                        <thead class="bg-info text-white">
                            <tr>
                                <th>Nro</th>
                                <th>Fecha</th>
                                <th>Proveedor</th>
                                <th>Productos</th>
                                <th>Usuario</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $contador = 1; @endphp
                            @foreach ($compras as $compra)
                                <tr>
                                    <td>{{ $contador++ }}</td>
                                    <td>{{ $compra->fecha }}</td>
                                    <td>{{ $compra->proveedor->nombreproveedor }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-info mostrar-detalles" data-detalles="{{ json_encode($compra->detallesCompra) }}" title="Ver Detalles">
                                            <i class="bi bi-list-ul"></i>
                                        </a>
                                    </td>
                                    <td>{{ $compra->user->name }}</td>
                                    <td>
                                        <div class="btn-group" style="gap: 5px;">
                                            <a href="{{ route('compras.show', $compra->id) }}" class="btn btn-primary btn-sm" title="Ver">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('compras.edit', $compra->id) }}" class="btn btn-success btn-sm" title="Editar">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('compras.destroy', $compra->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar esta compra?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <script>
                        $(function () {
                            $("#example1").DataTable({
                                pageLength: 10,
                                language: {
                                    emptyTable: "No hay información",
                                    info: "Mostrando _START_ a _END_ de _TOTAL_ compras",
                                    infoEmpty: "Mostrando 0 a 0 de 0 registros",
                                    infoFiltered: "(filtrado de _MAX_ total de compras)",
                                    lengthMenu: "Mostrar _MENU_ compras",
                                    loadingRecords: "Cargando...",
                                    processing: "Procesando...",
                                    search: "Buscar:",
                                    zeroRecords: "No se encontraron coincidencias",
                                    paginate: {
                                        first: "Primero",
                                        last: "Último",
                                        next: "Siguiente",
                                        previous: "Anterior"
                                    }
                                },
                                responsive: true,
                                lengthChange: true,
                                autoWidth: false,
                                searching: true,
                                buttons: [
                                    {
                                        extend: 'collection',
                                        text: 'Reportes',
                                        buttons: [
                                            { extend: 'copy', text: 'Copiar' },
                                            { extend: 'pdfHtml5', text: 'PDF', orientation: 'landscape' },
                                            { extend: 'csv', text: 'CSV' },
                                            { extend: 'excel', text: 'Excel' },
                                            { extend: 'print', text: 'Imprimir' }
                                        ]
                                    },
                                    {
                                        extend: 'colvis',
                                        text: 'Visor de columnas'
                                    }
                                ]
                            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

                            // Evento para mostrar los detalles al hacer clic en el icono
                            $('#example1').on('click', '.mostrar-detalles', function() {
                                var detalles = $(this).data('detalles');
                                var listaDetalles = '<ul class="list-group">';
                                detalles.forEach(function(detalle) {
                                    listaDetalles += '<li class="list-group-item">' +
                                        detalle.producto + ' (Cant: ' + detalle.cantidad + ', Precio: ' + detalle.precio_unitario + ')</li>';
                                });
                                listaDetalles += '</ul>';

                                Swal.fire({
                                    title: 'Detalles de la Compra',
                                    html: listaDetalles,
                                    confirmButtonText: 'Cerrar',
                                    customClass: { // Añade esta sección
                                        popup: 'modal-lg', // Clase para el modal
                                        content: 'modal-content',
                                        header: 'modal-header',
                                        body: 'modal-body',
                                        footer: 'modal-footer',
                                    },
                                });
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
