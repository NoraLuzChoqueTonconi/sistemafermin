@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 20px">
        <h1>Listado de Compras</h1>
        <br>

        @if(session('mensaje'))
            <div class="alert alert-success">
                {{ session('mensaje') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nro</th>
                            <th>Fecha</th>
                            <th>Proveedor</th>
                            <th>Productos</th>
                            <th>Usuario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($compras as $index => $compra)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $compra->fecha }}</td>
                                <td>{{ $compra->proveedor->nombreproveedor ?? 'N/A' }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info mostrar-detalles" data-compra-id="{{ $compra->id }}">
                                        <i class="fas fa-list"></i> Ver Detalles
                                    </button>
                                    <div id="detalles-compra-{{ $compra->id }}" class="detalles-compra oculto">
                                        <hr>
                                        <strong>Producto:</strong> {{ $compra->producto->nombreproducto ?? 'N/A' }}<br>
                                        <strong>Cantidad:</strong> {{ $compra->cantidad }}<br>
                                        <strong>Precio Compra:</strong> {{ $compra->preciocompra }}<br>
                                        <strong>Precio Venta:</strong> {{ $compra->precioventa }}<br>
                                        <strong>Descripción:</strong> {{ $compra->descripcion ?? 'N/A' }}
                                    </div>
                                </td>
                                <td>{{ $compra->user->name ?? 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('compras.show', $compra->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i> Ver</a>
                                    <a href="{{ route('compras.edit', $compra->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Editar</a>
                                    <form action="{{ route('compras.destroy', $compra->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta compra?')"><i class="fas fa-trash"></i> Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
        .detalles-compra {
            display: none; /* Inicialmente oculto */
        }
        .oculto {
            display: none;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const botonesMostrarDetalles = document.querySelectorAll('.mostrar-detalles');

            botonesMostrarDetalles.forEach(boton => {
                boton.addEventListener('click', function() {
                    const compraId = this.dataset.compraId;
                    const detallesDiv = document.getElementById(`detalles-compra-${compraId}`);
                    detallesDiv.classList.toggle('oculto'); // Alternar la clase 'oculto' para mostrar/ocultar
                });
            });
        });
    </script>
@endsection