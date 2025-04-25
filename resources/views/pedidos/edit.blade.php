@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 10px">
        <h1 class="text-center"><b>Actualizar Pedido</b></h1>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title"><b>Llene los datos del Pedido y sus Productos</b></h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('pedidos.update', $pedido->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="fecha">Fecha</label>
                                        <input type="date" name="fecha" value="{{ $pedido->fecha }}" class="form-control" required style="text-transform: uppercase;">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="id_proveedor">Proveedor</label>
                                        <select name="id_proveedor" class="form-control" required>
                                            @foreach ($proveedores as $proveedor)
                                                <option value="{{ $proveedor->id }}" {{ $pedido->id_proveedor == $proveedor->id ? 'selected' : '' }}>
                                                    {{ $proveedor->nombreproveedor }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="telefono">Teléfono</label>
                                        <input type="text" name="telefono" value="{{ $pedido->telefono }}" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-header">
                                <h3 class="card-title"><b>Productos del Pedido</b></h3>
                            </div>
                            <div class="card-body">
                                <div id="productos-container">
                                    @foreach ($pedido->detallesPedido as $detalle)
                                        <div class="row producto-item mt-2">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="productos[{{ $loop->index }}][id_producto]">Producto</label>
                                                    <select name="productos[{{ $loop->index }}][id_producto]" class="form-control producto-select" required>
                                                        <option value="" disabled>Seleccione un Producto</option>
                                                        @foreach ($productos as $producto)
                                                            <option value="{{ $producto->id }}" {{ $detalle->producto_id == $producto->id ? 'selected' : '' }}>
                                                                {{ $producto->nombreproducto }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="productos[{{ $loop->index }}][cantidad]">Cantidad</label>
                                                    <input type="number" name="productos[{{ $loop->index }}][cantidad]" class="form-control" value="{{ $detalle->cantidad }}" min="1" required>
                                                </div>
                                            </div>
                                            <div class="col-md-2 align-self-end">
                                                <button type="button" class="btn btn-danger eliminar-producto">Eliminar</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" id="agregar-producto" class="btn btn-success mt-2">Agregar Otro Producto</button>

                                <template id="producto-template">
                                    <div class="row producto-item mt-2">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="productos[__index__][id_producto]">Producto</label>
                                                <select name="productos[__index__][id_producto]" class="form-control producto-select" required>
                                                    <option value="" disabled selected>Seleccione un Producto</option>
                                                    @foreach ($productos as $producto)
                                                        <option value="{{ $producto->id }}">
                                                            {{ $producto->nombreproducto }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="productos[__index__][cantidad]">Cantidad</label>
                                                <input type="number" name="productos[__index__][cantidad]" class="form-control" value="1" min="1" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2 align-self-end">
                                            <button type="button" class="btn btn-danger eliminar-producto">Eliminar</button>
                                        </div>
                                    </div>
                                </template>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <a href="{{ url('/pedidos') }}" class="btn btn-secondary">Cancelar</a>
                                        <button type="submit" class="btn btn-success">Actualizar Pedido</button>
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
            const agregarProductoBtn = document.getElementById('agregar-producto');
            const productosContainer = document.getElementById('productos-container');
            const productoTemplate = document.getElementById('producto-template');
            let contadorProductos = document.querySelectorAll('.producto-item').length; // Inicializar con la cantidad existente

            agregarProductoBtn.addEventListener('click', function() {
                const nuevoProductoItem = productoTemplate.content.cloneNode(true);
                const productoDiv = nuevoProductoItem.querySelector('.producto-item');

                productoDiv.innerHTML = productoDiv.innerHTML.replace(/__index__/g, contadorProductos);

                productosContainer.appendChild(nuevoProductoItem);
                contadorProductos++;

                const botonesEliminar = document.querySelectorAll('.eliminar-producto');
                botonesEliminar.forEach(boton => {
                    boton.addEventListener('click', function() {
                        this.closest('.producto-item').remove();
                    });
                });
            });

            // Funcionalidad para eliminar productos existentes al cargar la página
            const botonesEliminarExistentes = document.querySelectorAll('.eliminar-producto');
            botonesEliminarExistentes.forEach(boton => {
                boton.addEventListener('click', function() {
                    this.closest('.producto-item').remove();
                });
            });
        });
    </script>
@endsection