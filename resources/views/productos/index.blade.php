@php
    use Illuminate\Support\Facades\Session;
@endphp

@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 20px">
        <h1>Listado de Productos</h1>

        {{-- ✅ Alerta de éxito con SweetAlert --}}
        @if ($message = Session::get('mensaje'))
            <script>
                Swal.fire({
                    title: "Buen trabajo!",
                    text: "{{ $message }}",
                    icon: "success"
                });
            </script>
        @endif

       {{-- ✅ Alerta de Stock Bajo --}}
        @if ($productos->where('stock', '<', 10)->count() > 0)
        <div class="alert alert-danger text-center font-bold">
            ⚠️ ¡Atención! Los siguientes productos tienen stock menor a 10:  
            <ul class="mt-2">
                @foreach ($productos->where('stock', '<', 10) as $producto)
                    <li>{{ $producto->nombre }} (Stock: {{ $producto->nombreproducto }})</li>
                @endforeach
            </ul>
        </div>
        @endif


        <div class="row">
            <div class="col-md-10">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><b>Listado de Registrados</b></h3>
                        <div class="card-tools">
                            <a href="{{ url('/productos/create') }}" class="btn btn-primary">
                                <i class="bi bi-file-plus"></i> Agregar Nuevo Producto
                            </a>
                        </div>
                    </div>
                    <div class="card-body" style="display: block;">
                        <table id="example1" class="table table-bordered table-striped table-sm">
                            <thead class="bg-info text-white">
                                <tr>
                                    <th>Nro</th>
                                    <th>Codigo</th>
                                    <th>Categoria</th>
                                    <th>Nombre del Producto</th>
                                    <th>Descripción</th>
                                    <th>Stock</th>
                                    <th>Precio Compra</th>
                                    <th>Precio Venta</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $contador = 0; ?>
                                @foreach ($productos as $producto)
                                    <tr>
                                        <td>{{ ++$contador }}</td>
                                        <td>{{ $producto->codigo }}</td>
                                        <td>{{ $producto->categoria->nombrecategoria }}</td>
                                        <td>{{ $producto->nombreproducto }}</td>
                                        <td>{{ $producto->descripcion }}</td>
                                        
                                        <td>                                             
                                            <span class="badge text-white {{ $producto->stock < 10 ? 'bg-danger' : 'bg-success' }}">
                                                {{ $producto->stock }}
                                            </span>                                            
                                        </td>
                                        
                                        @if ($producto->stock == 10)
                                            <script>
                                                alert('¡Atención! El producto "{{ $producto->nombre }}" tiene un stock de 10. Considera reabastecerlo.');
                                            </script>
                                        @endif
                                        
                                        
                                        

                                        <td>{{ $producto->preciocompra }}</td>
                                        <td>{{ $producto->precioventa }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Acciones">
                                                <a href="{{ url('productos', $producto->id) }}" class="btn btn-primary">
                                                    <i class="bi bi-eye"></i> 
                                                </a>
                                                <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-success">
                                                    <i class="bi bi-pencil"></i> 
                                                </a>
                                                <form action="{{ url('productos', $producto->id) }}" method="POST" style="display:inline;">
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
                                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Productos",
                                        "infoEmpty": "Mostrando 0 a 0 de 0 Información",
                                        "infoFiltered": "(Filtrado de _MAX_ total Productos)",
                                        "lengthMenu": "Mostrar _MENU_ Productos",
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
