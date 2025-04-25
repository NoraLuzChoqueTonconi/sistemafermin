@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 20px">
        <h1>Listado  de Usuarios</h1>

        @if ($message = Session::get('mensaje'))
            <script>
                Swal.fire({
                    title: "Buen trabajo!",
                    text: "{{ $message }}",
                    icon: "success"
                });
            </script>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><b>Listado de Registros</b></h3>
                        <div class="card-tools">
                            <a href="{{ url('/users/create') }}" class="btn btn-primary btn-lg">
                                <i class="bi bi-file-plus"></i> Agregar Nuevo Usuario
                            </a>
                        </div>
                    </div>
                    <div class="card-body" style="display: block;">
                        <table id="example1" class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <thead class="bg-info text-white">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Correo Electrónico</th>
                                            <th>Roles</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    @forelse ($user->roles as $role)
                                                        <span class="badge badge-primary">{{ $role->name }}</span>
                                                    @empty
                                                        <span class="badge badge-secondary">Sin roles</span>
                                                    @endforelse
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Acciones">
                                                        <a href="{{ url('users', $user->id) }}" class="btn btn-primary">
                                                            <i class="bi bi-eye"></i> 
                                                        </a>
                                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-success">
                                                            <i class="bi bi-pencil"></i> 
                                                        </a>
                                                        <form action="{{ url('users', $user->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            {{ method_field('DELETE') }}
                                                            <button type="submit" onclick="return confirm('¿Estás seguro de eliminar este registro?')" class="btn btn-danger">
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
                                        "info": "Mostrando _START_ a _END_ de _TOTAL_ User",
                                        "infoEmpty": "Mostrando 0 a 0 de 0 Información",
                                        "infoFiltered": "(Filtrado de _MAX_ total User)",
                                        "lengthMenu": "Mostrar _MENU_ User",
                                        "loadingRecords": "Cargando...",
                                        "processing": "Procesando...",
                                        "search": "Buscador:",
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
                                    buttons: [
                                        {
                                            extend: 'collection',
                                            text: 'Reportes',
                                            orientation: 'landscape',
                                            buttons: [
                                                { extend: 'copy', text: 'Copiar' },
                                                { extend: 'pdf' },
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
                                    ],
                                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
