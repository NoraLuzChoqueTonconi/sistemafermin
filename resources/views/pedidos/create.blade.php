@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 20px">
        <h1 class="text-center"><b>Crear un Nuevo Pedido</b></h1><br>

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
                        <h3 class="card-title"><b>Llene los Datos del Pedido</b></h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/pedidos') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="fecha">Fecha</label> <b>*</b>
                                        <input type="date" name="fecha" value="{{ old('fecha') }}"
                                               class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="id_proveedor">Proveedor</label> <b>*</b>
                                        <select name="id_proveedor" class="form-control" required>
                                            <option value="" disabled selected>Seleccione un Proveedor</option>
                                            @foreach ($proveedors as $proveedor)
                                                <option value="{{ $proveedor->id }}" {{ old('id_proveedor') == $proveedor->id ? 'selected' : '' }}>
                                                    {{ $proveedor->nombreproveedor }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="telefono">Teléfono</label> <b>*</b>
                                        <input type="text" name="telefono" value="{{ old('telefono') }}"
                                               class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-header">
                                <h3 class="card-title"><b>Seleccione los Productos</b></h3>
                            </div>
                            <div class="card-body">
                                <div id="productos-container">
                                    </div>
                                <button type="button" id="agregar-producto" class="btn btn-success mt-2">Agregar Producto</button>

                                <template id="producto-template">
                                    <div class="row producto-item mt-2">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="productos[__index__][id_producto]">Producto</label> <b>*</b>
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
                                                <label for="productos[__index__][cantidad]">Cantidad</label> <b>*</b>
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
                                        <button type="submit" class="btn btn-primary">Guardar Pedido</button>
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
            let contadorProductos = 0;

            agregarProductoBtn.addEventListener('click', function() {
                const nuevoProductoItem = productoTemplate.content.cloneNode(true);
                const productoDiv = nuevoProductoItem.querySelector('.producto-item');

                // Reemplazar el índice "__index__" con el contador actual
                productoDiv.innerHTML = productoDiv.innerHTML.replace(/__index__/g, contadorProductos);

                productosContainer.appendChild(nuevoProductoItem);
                contadorProductos++;

                // Agregar funcionalidad para eliminar el producto agregado
                const botonesEliminar = document.querySelectorAll('.eliminar-producto');
                botonesEliminar.forEach(boton => {
                    boton.addEventListener('click', function() {
                        this.closest('.producto-item').remove();
                    });
                });
            });
        });
    </script>
@endsection