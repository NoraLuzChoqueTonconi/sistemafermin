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
                                    <h3 class="card-title"><b>Listado Registrados</b></h3>
                                    <div class="card-tools">
                                        <a href="{{ url('/categorias/create') }}" class="btn btn-primary btn-lg">
                                            <i class="bi bi-file-plus"></i> Agregar Nueva Categoria
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body" style="display: block;">

                                    <div class="mb-3">
                                        <div class="btn-group">
                                            
                                        </div>
                                        
                                    </div>

                                    <table id="example1" class="table table-bordered table-striped table-sm">
                                        <thead class="bg-info text-white">
                                            <tr>
                                                <th>Nro</th>
                                                <th>Codigo de Categoria</th>
                                                <th>Nombre de Categoria</th>
                                                <th>Imagen</th>
                                                <th>Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $contador = 0; ?>
                                            @foreach ($categorias as $categoria)
                                                <tr>
                                                    <td><?php echo ++$contador; ?></td>
                                                    <td>{{ $categoria->codigo }}</td>
                                                    <td>{{ $categoria->nombrecategoria }}</td>
                                                    <td>
                                                        <img src="{{asset('storage/'.$categoria->imagen)}}" width="80px" alt="imagen">
                                                    </td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Acciones" style="display: flex; gap: 5px;">
                                                            <a href="{{ url('categorias', $categoria->id) }}" class="btn btn-primary btn-lg">
                                                                <i class="bi bi-eye"></i>
                                                            </a>
                                                            <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-success btn-lg">
                                                                <i class="bi bi-pencil"></i>
                                                            </a>
                                                            <form action="{{ url('categorias', $categoria->id) }}" method="POST" style="margin: 0;">
                                                                @csrf
                                                                {{ method_field('DELETE') }}
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
                                                "pageLength": 10,
                                                "language": {
                                                    "emptyTable": "No hay información",
                                                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Categorias",
                                                    "infoEmpty": "Mostrando 0 a 0 de 0 Información",
                                                    "infoFiltered": "(Filtrado de _MAX_ total Categorias)",
                                                    "lengthMenu": "Mostrar _MENU_ Categorias",
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
                                                    
                                                ],
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