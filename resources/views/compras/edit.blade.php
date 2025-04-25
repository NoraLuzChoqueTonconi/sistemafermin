@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 10px">
        <h1 class="text-center"><b>Editar Compra</b></h1>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title"><b>Modifique los Datos de la Compra y sus Detalles</b></h3>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('compras.update', $compra->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fecha">Fecha </label>
                                            <input type="date" name="fecha" value="{{ $compra->fecha }}" class="form-control" required style="text-transform: uppercase;">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="id_proveedor">Proveedor </label>
                                            <select name="id_proveedor" class="form-control" required>
                                                <option value="">Seleccione un Proveedor</option>
                                                @foreach ($proveedores as $proveedor)
                                                    <option value="{{ $proveedor->id }}" {{ $compra->id_proveedor == $proveedor->id ? 'selected' : '' }}>
                                                        {{ $proveedor->nombreproveedor }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="id_user">Usuario</label>
                                            <select name="id_user" class="form-control" required>
                                                <option value="">Seleccione un Usuario</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}" {{ $compra->id_user == $user->id ? 'selected' : '' }}>
                                                        {{ $user->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <h3>Detalles de la Compra</h3>
                                <div id="detalles-compra">
                                    @foreach ($compra->detallesCompra as $index => $detalle)
                                        <div class="detalle-compra-item">
                                            <div class="form-row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="productos[{{ $index }}][id_producto]">Producto</label> <b>*</b>
                                                    <select class="form-control producto-select" name="productos[{{ $index }}][id_producto]" required>
                                                        <option value="">Seleccione un Producto</option>
                                                        @foreach ($productos as $producto)
                                                            <option value="{{ $producto->id }}" {{ $detalle->id_producto == $producto->id ? 'selected' : '' }}>
                                                                {{ $producto->nombreproducto }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-2 mb-3">
                                                    <label for="productos[{{ $index }}][cantidad]">Cantidad</label> <b>*</b>
                                                    <input type="number" class="form-control" name="productos[{{ $index }}][cantidad]" value="{{ $detalle->cantidad }}" min="1" required>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="productos[{{ $index }}][precio_unitario]">Precio Unitario</label> <b>*</b>
                                                    <input type="number" class="form-control" name="productos[{{ $index }}][precio_unitario]" step="0.01" value="{{ $detalle->precio_unitario }}" required>
                                                </div>
                                                <div class="col-md-2 mb-3">
                                                    <label for="productos[{{ $index }}][descripcion]">Descripción (Opcional)</label>
                                                    <input type="text" class="form-control" name="productos[{{ $index }}][descripcion]" value="{{ $detalle->descripcion }}">
                                                </div>
                                                <div class="col-md-1 mb-3">
                                                    <button type="button" class="btn btn-danger btn-sm eliminar-detalle">Eliminar</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <button type="button" id="agregar-detalle" class="btn btn-success">Agregar Producto</button>

                                <hr>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-gro">
                                            <a href="{{ route('compras.index') }}" class="btn btn-secondary">Cancelar</a>
                                            <button type="submit" class="btn btn-success">Actualizar Compra</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const detallesCompraDiv = document.getElementById('detalles-compra');
            const agregarDetalleButton = document.getElementById('agregar-detalle');
            let contadorDetalles = detallesCompraDiv.querySelectorAll('.detalle-compra-item').length;

            agregarDetalleButton.addEventListener('click', function() {
                const nuevoDetalle = document.createElement('div');
                nuevoDetalle.classList.add('detalle-compra-item');
                nuevoDetalle.innerHTML = `
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="productos[${contadorDetalles}][id_producto]">Producto</label> <b>*</b>
                            <select class="form-control producto-select" name="productos[${contadorDetalles}][id_producto]" required>
                                <option value="" disabled selected>Seleccione un Producto</option>
                                @foreach ($productos as $producto)
                                    <option value="{{ $producto->id }}">{{ $producto->nombreproducto }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="productos[${contadorDetalles}][cantidad]">Cantidad</label> <b>*</b>
                            <input type="number" class="form-control" name="productos[${contadorDetalles}][cantidad]" value="1" min="1" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="productos[${contadorDetalles}][precio_unitario]">Precio Unitario</label> <b>*</b>
                            <input type="number" class="form-control" name="productos[${contadorDetalles}][precio_unitario]" step="0.01" required>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="productos[${contadorDetalles}][descripcion]">Descripción (Opcional)</label>
                            <input type="text" class="form-control" name="productos[${contadorDetalles}][descripcion]">
                        </div>
                        <div class="col-md-1 mb-3">
                            <button type="button" class="btn btn-danger btn-sm eliminar-detalle">Eliminar</button>
                        </div>
                    </div>
                `;
                detallesCompraDiv.appendChild(nuevoDetalle);
                contadorDetalles++;

                const botonesEliminar = nuevoDetalle.querySelectorAll('.eliminar-detalle');
                botonesEliminar.forEach(boton => {
                    boton.addEventListener('click', function() {
                        this.closest('.detalle-compra-item').remove();
                    });
                });
            });

            detallesCompraDiv.addEventListener('click', function(event) {
                if (event.target.classList.contains('eliminar-detalle')) {
                    event.target.closest('.detalle-compra-item').remove();
                }
            });
        });
    </script>
@endsection