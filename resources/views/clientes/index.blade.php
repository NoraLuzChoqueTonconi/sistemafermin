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
                                    <h3 class="card-title"><b>Listado de Clientes</b></h3>
                                    <div class="card-tools">
                                        <a href="{{ url('/clientes/create') }}" class="btn btn-primary btn-lg">
                                            <i class="bi bi-file-plus"></i> Agregar Nuevo Cliente
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body" style="display: block;">
                                    <table id="example1" class="table table-bordered table-striped table-sm">
                                        <thead class="bg-info text-white">
                                            <tr>
                                                <th>Nro</th>
                                                <th>Nombre Completo</th>
                                                <th>C.I</th>
                                                <th>Celular</th>
                                                <th>Email</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $contador = 1; @endphp
                                            @foreach ($clientes as $cliente)
                                                <tr>
                                                    <td>{{ $contador++ }}</td>
                                                    <td>{{ $cliente->nombre_completo }}</td>
                                                    <td>{{ $cliente->ci }}</td>
                                                    <td>{{ $cliente->celular }}</td>
                                                    <td>{{ $cliente->email }}</td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Acciones" style="gap: 5px;">
                                                            <a href="{{ url('clientes', $cliente->id) }}" class="btn btn-primary btn-sm" title="Ver">
                                                                <i class="bi bi-eye"></i>
                                                            </a>
                                                            <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-success btn-sm" title="Editar">
                                                                <i class="bi bi-pencil"></i>
                                                            </a>
                                                            <form action="{{ url('clientes', $cliente->id) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm" title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar este registro?')">
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
                                                "pageLength": 10,
                                                "language": {
                                                    "emptyTable": "No hay información",
                                                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Clientes",
                                                    "infoEmpty": "Mostrando 0 a 0 de 0 registros",
                                                    "infoFiltered": "(Filtrado de _MAX_ total Clientes)",
                                                    "lengthMenu": "Mostrar _MENU_ Clientes",
                                                    "loadingRecords": "Cargando...",
                                                    "processing": "Procesando...",
                                                    "search": "Buscar:",
                                                    "zeroRecords": "Sin resultados encontrados",
                                                    "paginate": {
                                                        "first": "Primero",
                                                        "last": "Último",
                                                        "next": "Siguiente",
                                                        "previous": "Anterior"
                                                    }
                                                },
                                                "responsive": true,
                                                "lengthChange": true,
                                                "autoWidth": false,
                                                "searching": true,
                                                "buttons": [
                                                    {
                                                        extend: 'collection',
                                                        text: 'Reportes',
                                                        orientation: 'landscape',
                                                        buttons: [
                                                            { text: 'Copiar', extend: 'copy' },
                                                            { extend: 'pdf' },
                                                            { extend: 'csv' },
                                                            { extend: 'excel' },
                                                            { text: 'Imprimir', extend: 'print' }
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
