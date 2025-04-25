@php
    use Illuminate\Support\Facades\Session;
@endphp

@extends('layouts.admin')

@section('content')

{{-- Ocultar columnas y centrar formulario en impresión --}}
<style>
    @media print {
        .no-print {
            display: none !important;
        }
        .panel { /* Selecciona el contenedor principal del formulario */
            display: flex !important;
            justify-content: center !important;
        }
    }
</style>

<div class="row">
    <div class="col-lg-12">
        <div id="demo-panel-network" class="panel">
            <div class="panel-body">
                <div class="row">
                    <div class="content" style="margin-left: 20px">
                        @if ($message = Session::get('mensaje'))
                            <script>
                                Swal.fire({
                                    title: "Buen trabajo!",
                                    text: "{{ $message }}",
                                    icon: "success"
                                });
                            </script>
                        @endif

                        <div class="col-md-12">
                            <div class="card card-outline card-primary">
                                <div class="card-header">
                                    <h3 class="card-title"><b>Listado de Ventas</b></h3>
                                    <div class="card-tools">
                                        <a href="{{ url('/ventas/create') }}" class="btn btn-primary btn-lg">
                                            <i class="bi bi-file-plus"></i> Agregar Nueva Venta
                                        </a>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped table-sm">
                                        <thead class="bg-info text-white">
                                            <tr>
                                                <th>Nro</th>
                                                <th>Fecha</th>
                                                <th>Nombre del Cliente</th>
                                                <th>Total Pagado</th>
                                                <th class="no-print">Ver Detalle</th>
                                                <th class="no-print">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $contador = 0; @endphp
                                            @foreach ($ventas as $venta)
                                                <tr>
                                                    <td>{{ ++$contador }}</td>
                                                    <td>{{ $venta->Fecha }}</td>
                                                    <td>{{ $venta->cliente->nombre_completo }}</td>
                                                    <td>{{ number_format($venta->totalpagado, 2) }}</td>
                                                    <td class="text-center no-print">
                                                        <button onclick="mostrarDetalles({{ $venta->id }})" class="btn btn-info btn-sm">
                                                            <i class="bi bi-list-ul"></i>
                                                        </button>
                                                    </td>
                                                    <td class="no-print">
                                                        <div class="btn-group" role="group" style="display: flex; gap: 5px;">
                                                            <a href="{{ url('ventas', $venta->id) }}" class="btn btn-primary btn-sm">
                                                                <i class="bi bi-printer"></i>
                                                            </a>
                                                            <a href="{{ route('ventas.edit', $venta->id) }}" class="btn btn-success btn-sm">
                                                                <i class="bi bi-pencil"></i>
                                                            </a>
                                                            <form action="{{ url('ventas', $venta->id) }}" method="POST" style="margin: 0;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" onclick="return deleteConfirmation()" class="btn btn-danger btn-sm">
                                                                    <i class="bi bi-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <div class="modal fade" id="modalDetalleVenta" tabindex="-1" aria-labelledby="detalleVentaLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header bg-info text-white">
                                                    <h5 class="modal-title" id="detalleVentaLabel">Detalle de la Venta</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                </div>
                                                <div class="modal-body" id="detalleContenido">
                                                    </div>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        $(function () {
                                            $("#example1").DataTable({
                                                pageLength: 10,
                                                responsive: true,
                                                lengthChange: true,
                                                autoWidth: false,
                                                searching: true,
                                                language: {
                                                    emptyTable: "No hay información",
                                                    info: "Mostrando _START_ a _END_ de _TOTAL_ ventas",
                                                    infoEmpty: "Mostrando 0 a 0 de 0 ventas",
                                                    infoFiltered: "(Filtrado de _MAX_ total ventas)",
                                                    lengthMenu: "Mostrar _MENU_ ventas",
                                                    loadingRecords: "Cargando...",
                                                    processing: "Procesando...",
                                                    search: "Buscador:",
                                                    zeroRecords: "Sin resultados encontrados",
                                                    paginate: {
                                                        first: "Primero",
                                                        last: "Último",
                                                        next: "Siguiente",
                                                        previous: "Anterior"
                                                    }
                                                },
                                                buttons: [
                                                    {
                                                        extend: 'collection',
                                                        text: 'Reportes',
                                                        buttons: [
                                                            {
                                                                extend: 'pdf',
                                                                text: 'PDF',
                                                                title: 'Ferretería Fermín - Reporte de Ventas',
                                                                download: 'open',
                                                                orientation: 'landscape',
                                                                pageSize: 'A4',
                                                                exportOptions: {
                                                                    columns: [0, 1, 2, 3]
                                                                }
                                                            },
                                                            {
                                                                extend: 'print',
                                                                text: 'Imprimir',
                                                                title: 'Ferretería Fermín - Reporte de Ventas',
                                                                exportOptions: {
                                                                    columns: [0, 1, 2, 3]
                                                                }
                                                            }
                                                        ]
                                                    },
                                                    {
                                                        extend: 'colvis',
                                                        text: 'Visor de columnas',
                                                        collectionLayout: 'fixed three-column'
                                                    }
                                                ],
                                                dom: 'Bfrtip' // Asegura que los botones se rendericen correctamente
                                            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                                        });

                                        function deleteConfirmation() {
                                            return Swal.fire({
                                                title: '¿Estás seguro?',
                                                text: 'Una vez eliminada, esta venta no podrá ser recuperada.',
                                                icon: 'warning',
                                                showCancelButton: true,
                                                confirmButtonText: 'Sí, eliminar',
                                                cancelButtonText: 'Cancelar'
                                            }).then((result) => result.isConfirmed);
                                        }

                                        function mostrarDetalles(ventaId) {
                                            fetch(`/ventas/${ventaId}/detalle`)
                                                .then(response => response.text())
                                                .then(html => {
                                                    document.getElementById('detalleContenido').innerHTML = html;
                                                    new bootstrap.Modal(document.getElementById('modalDetalleVenta')).show();
                                                })
                                                .catch(error => {
                                                    console.error("Error al cargar los detalles:", error);
                                                });
                                        }
                                    </script>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection