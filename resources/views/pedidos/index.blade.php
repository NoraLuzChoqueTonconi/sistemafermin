@php
    use Illuminate\Support\Facades\Session;
@endphp

@extends('layouts.admin')

@section('content')
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
                                    <h3 class="card-title"><b>Listado de Pedidos Registrados</b></h3>
                                    <div class="card-tools">
                                        <a href="{{ url('/pedidos/create') }}" class="btn btn-primary btn-lg">
                                            <i class="bi bi-file-plus"></i> Agregar Nuevo Pedido
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
                                                <th>Teléfono</th>
                                                <th>Productos</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $contador = 1; @endphp
                                            @foreach ($pedidos as $pedido)
                                                <tr>
                                                    <td>{{ $contador++ }}</td>
                                                    <td>{{ $pedido->fecha }}</td>
                                                    <td>{{ $pedido->proveedor?->nombreproveedor ?? 'Proveedor no asignado' }}</td>
                                                    <td>{{ $pedido->telefono }}</td>
                                                    <td>
                                                        @if ($pedido->detallesPedido->isNotEmpty())
                                                            <ul>
                                                                @foreach ($pedido->detallesPedido as $detalle)
                                                                    <li>{{ $detalle->producto->nombreproducto }} (Cantidad: {{ $detalle->cantidad }})</li>
                                                                @endforeach
                                                            </ul>
                                                        @else
                                                            Sin productos
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="btn-group" style="display: flex; gap: 5px;">
                                                            <a href="{{ url('pedidos', $pedido->id) }}" class="btn btn-primary btn-lg">
                                                                <i class="bi bi-eye"></i>
                                                            </a>
                                                            <a href="{{ route('pedidos.edit', $pedido->id) }}" class="btn btn-success btn-lg">
                                                                <i class="bi bi-pencil"></i>
                                                            </a>
                                                            <form action="{{ url('pedidos', $pedido->id) }}" method="POST" style="margin: 0;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" onclick="return confirm('¿Estás seguro de eliminar este registro?')" class="btn btn-danger btn-lg">
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
                                        $(function() {
                                            $("#example1").DataTable({
                                                pageLength: 10,
                                                language: {
                                                    emptyTable: "No hay información",
                                                    info: "Mostrando _START_ a _END_ de _TOTAL_ pedidos",
                                                    infoEmpty: "Mostrando 0 a 0 de 0 pedidos",
                                                    infoFiltered: "(filtrado de _MAX_ pedidos totales)",
                                                    lengthMenu: "Mostrar _MENU_ pedidos",
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
                                                responsive: true,
                                                lengthChange: true,
                                                autoWidth: false,
                                                searching: true,
                                                buttons: [
                                                    {
                                                        extend: 'collection',
                                                        text: 'Reportes',
                                                        orientation: 'landscape',
                                                        buttons: [
                                                            { extend: 'copy', text: 'Copiar' },
                                                            { extend: 'pdf', text: 'PDF', download: 'open' },
                                                            { extend: 'csv' },
                                                            { extend: 'excel' },
                                                            { extend: 'print', text: 'Imprimir' }
                                                        ]
                                                    },
                                                    {
                                                        extend: 'colvis',
                                                        text: 'Visor de columnas',
                                                        collectionLayout: 'fixed three-column'
                                                    }
                                                ]
                                            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                                        });
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