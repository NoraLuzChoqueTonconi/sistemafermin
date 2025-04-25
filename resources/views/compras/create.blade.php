@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 20px">
        <h1 class="text-center"><b>Crear una Nueva Compra</b></h1><br>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-md-11">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><b>Llene los Datos de la Compra y sus Detalles</b></h3>
                    </div>
                    <div class="card card-body">
                        <form action="{{ route('compras.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="fecha">Fecha</label> <b>*</b>
                                        <input type="date" name="fecha" id="fecha" value="{{ old('fecha') }}" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="id_proveedor">Proveedor</label> <b>*</b>
                                        <select name="id_proveedor" id="id_proveedor" class="form-control" required>
                                            <option value="" disabled selected>Seleccione un Proveedor</option>
                                            @foreach ($proveedores as $proveedor)
                                                <option value="{{ $proveedor->id }}" {{ old('id_proveedor') == $proveedor->id ? 'selected' : '' }}>
                                                    {{ $proveedor->nombreproveedor }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="id_user">Usuario</label> <b>*</b>
                                        <select name="id_user" id="id_user" class="form-control" required>
                                            <option value="" disabled {{ !isset($registro->id_user) ? 'selected' : '' }}>Seleccione un Usuario</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}" {{ (old('id_user', $registro->id_user ?? '') == $user->id) ? 'selected' : '' }}>
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
                                <div class="detalle-compra-item">
                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <label for="productos[0][id_producto]">Producto</label> <b>*</b>
                                            <select class="form-control producto-select" name="productos[0][id_producto]" required>
                                                <option value="" disabled selected>Seleccione un Producto</option>
                                                @foreach ($productos as $producto)
                                                    <option value="{{ $producto->id }}">{{ $producto->nombreproducto }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label for="productos[0][cantidad]">Cantidad</label> <b>*</b>
                                            <input type="number" class="form-control" name="productos[0][cantidad]" value="1" min="1" required>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="productos[0][preciocompra]">Precio Compra</label> <b>*</b>
                                            <input type="number" class="form-control" name="productos[0][preciocompra]" step="0.01" required>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="productos[0][precioventa]">Precio Venta</label> <b>*</b>
                                            <input type="number" class="form-control" name="productos[0][precioventa]" step="0.01" required>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="productos[0][descripcion]">Descripción (Opcional)</label>
                                            <input type="text" class="form-control" name="productos[0][descripcion]">
                                        </div>
                                        <div class="col-md-1 mb-3">
                                            <button type="button" class="btn btn-danger btn-sm eliminar-detalle" disabled>Eliminar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="button" id="agregar-detalle" class="btn btn-success">Agregar Producto</button>

                            <hr>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <a href="{{ route('compras.index') }}" class="btn btn-secondary">Cancelar</a>
                                        <button type="submit" class="btn btn-primary">Guardar Compra</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const detallesCompraDiv = document.getElementById('detalles-compra');
            const agregarDetalleButton = document.getElementById('agregar-detalle');
            let contadorDetalles = 1;

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
                        <div class="col-md-2 mb-2">
                            <label for="productos[${contadorDetalles}][cantidad]">Cantidad</label> <b>*</b>
                            <input type="number" class="form-control" name="productos[${contadorDetalles}][cantidad]" value="1" min="1" required>
                        </div>
                        <div class="col-md-2 mb-2">
                            <label for="productos[${contadorDetalles}][preciocompra]">Precio Compra</label> <b>*</b>
                            <input type="number" class="form-control" name="productos[${contadorDetalles}][preciocompra]" step="0.01" required>
                        </div>
                        <div class="col-md-2 mb-2">
                            <label for="productos[${contadorDetalles}][precioventa]">Precio Venta</label> <b>*</b>
                            <input type="number" class="form-control" name="productos[${contadorDetalles}][precioventa]" step="0.01" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="productos[${contadorDetalles}][descripcion]">Descripción </label>
                            <input type="text" class="form-control" name="productos[${contadorDetalles}][descripcion]">
                        </div>
                        <div class="col-md-1 mb-3">
                            <button type="button" class="btn btn-danger btn-sm eliminar-detalle">Eliminar</button>
                        </div>
                    </div>
                `;
                detallesCompraDiv.appendChild(nuevoDetalle);
                contadorDetalles++;

                // Agregar evento para eliminar el detalle recién creado
                const botonesEliminar = nuevoDetalle.querySelectorAll('.eliminar-detalle');
                botonesEliminar.forEach(boton => {
                    boton.addEventListener('click', function() {
                        this.closest('.detalle-compra-item').remove();
                    });
                });
            });

            // Evento para eliminar detalles existentes
            detallesCompraDiv.addEventListener('click', function(event) {
                if (event.target.classList.contains('eliminar-detalle')) {
                    event.target.closest('.detalle-compra-item').remove();
                }
            });
        });
    </script>
@endsection