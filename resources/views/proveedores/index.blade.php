@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 20px">
        <h1>Listado de Proveedores</h1>

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
                            <a href="{{ url('/proveedores/create') }}" class="btn btn-primary btn-lg">
                                <i class="bi bi-file-plus"></i> Agregar Nuevo Proveedor
                            </a>
                        </div>
                    </div>
                    <div class="card-body" style="display: block;">
                        <table id="example1" class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <thead class="bg-info text-white">
                                    <th>Nro</th>
                                    <th class="col-nombre">Nombre del Proveedor</th> <!-- Clase agregada -->
                                    <th>Celular</th>
                                    <th>Email</th>
                                    <th>Empresa</th>
                                    <th>Direccion</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $contador = 0; ?>
                                @foreach ($proveedores as $proveedor)
                                    <tr>
                                        <td><?php echo $contador = $contador + 1; ?></td>
                                        <td class="col-nombre">{{ $proveedor->nombreproveedor }}</td> <!-- Aplica la clase aquí -->
                                        <td>{{ $proveedor->celular}}</td>
                                        <td>{{ $proveedor->email }}</td>
                                        <td>{{ $proveedor->empresa }}</td>
                                        <td>{{ $proveedor->direccion }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Acciones">
                                                <!-- Botón Ver -->
                                                <a href="{{ url('proveedores', $proveedor->id) }}" class="btn btn-primary">
                                                    <i class="bi bi-eye"></i> 
                                                </a>
                                        
                                                <!-- Botón Editar -->
                                                <a href="{{ route('proveedores.edit', $proveedor->id) }}" class="btn btn-success">
                                                    <i class="bi bi-pencil"></i> 
                                                </a>
                                        
                                                <!-- Formulario Eliminar -->
                                                <form action="{{ url('proveedores', $proveedor->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" onclick="return confirm('¿Estás seguro de eliminar este proveedor?')" class="btn btn-danger">
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
                                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Proveedor",
                                        "infoEmpty": "Mostrando 0 a 0 de 0 Informacion",
                                        "infoFiltered": "(Filtrado de _MAX_ total Proveedor)",
                                        "infoPostFix": "",
                                        "thousands": ",",
                                        "lengthMenu": "Mostrar _MENU_ Proveedor",
                                        "loadingRecords": "Cargando...",
                                        "processing": "Procesando...",
                                        "search": "Buscador:",
                                        "zeroRecords": "Sin resultados encontrados",
                                        "paginate": {
                                            "first": "Primero",
                                            "last": "Ultimo",
                                            "next": "Siguiente",
                                            "previous": "Anterior"
                                        }
                                    },
                                    "responsive": true,
                                    "lengthChange": true,
                                    "autoWidth": false,
                                    "searching": true, // Habilitar búsqueda en todos los campos
                                    buttons: [{
                                            extend: 'collection',
                                            text: 'Reportes',
                                            orientation: 'landscape',
                                            buttons: [{
                                                text: 'Copiar',
                                                extend: 'copy',
                                            }, {
                                                extend: 'pdf'
                                            }, {
                                                extend: 'csv'
                                            }, {
                                                extend: 'excel'
                                            }, {
                                                text: 'Imprimir',
                                                extend: 'print'
                                            }]
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

@section('styles')
    <style>
        /* Reducir el ancho de la columna "Nombre del Proveedor" */
        .col-nombre {
            width: 150px; /* Ajusta este valor según lo necesites */
            word-wrap: break-word; /* Asegura que el texto largo no se desborde */
        }
    </style>
@endsection
