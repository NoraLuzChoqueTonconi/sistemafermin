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
                        {{-- <div class="row"> --}}
                            <div class="col-md-12">
                                <div class="card card-outline card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title"><b>Listado de Medidas</b></h3>
                                        <div class="card-tools">
                                            <a href="{{ url('/medidas/create') }}" class="btn btn-primary btn-lg">
                                                <i class="bi bi-file-plus"></i> Agregar Nueva Medida
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body" style="display: block;">
                                        <table id="example1" class="table table-bordered table-striped table-sm">
                                            <thead>
                                                <thead class="bg-info text-white">
                                                <tr>
                                                    <th>Nro</th>
                                                    <th>Nombre de Medidas</th>
                                                    <th>Sigla de Medidas</th>
                                                    <th>Estado</th>
                                                    <th>Accion</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $contador = 0; ?>
                                                @foreach ($medidas as $medida)
                                                    <tr>
                                                        <td><?php echo $contador = $contador + 1; ?></td>
                                                        <td>{{ $medida->nombremedida }}</td>
                                                        <td>{{ $medida->siglamedida }}</td>
                                                        {{-- <td>{{ $medida->estado }}</td> --}}
                                                        <td>
                                                            @if ($medida->estado == 0)
                                                                <span class="badge bg-danger"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Inactivo</font></font></span>
                                                            @else
                                                                <span class="badge bg-primary"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Activo</font></font></span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Acciones" style="display: flex; gap: 5px;">
                                                                <a href="{{ url('medidas', $medida->id) }}" class="btn btn-primary btn-lg">
                                                                    <i class="bi bi-eye"></i>
                                                                </a>
                                                                <a href="{{ route('medidas.edit', $medida->id) }}" class="btn btn-success btn-lg">
                                                                    <i class="bi bi-pencil"></i>
                                                                </a>
                                                                <form action="{{ url('medidas', $medida->id) }}" method="POST" style="margin: 0;">
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
                                                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Categoria",
                                                        "infoEmpty": "Mostrando 0 a 0 de 0 Informacion",
                                                        "infoFiltered": "(Filtrado de _MAX_ total Categoria)",
                                                        "infoPostFix": "",
                                                        "thousands": ",",
                                                        "lengthMenu": "Mostrar _MENU_ Categoria",
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
                                                    "searching": true,
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
                        {{-- </div> --}}
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
