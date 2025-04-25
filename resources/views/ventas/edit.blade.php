@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 10px">
        <h1 class="text-center"><b>Actualizar las Ventas</b></h1>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title"><b>Llene los datos de forma correcta</b></h3>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ url('/ventas', $venta->id) }}">
                                @csrf
                                {{ method_field('PATCH') }}
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="Fecha">Fecha</label>
                                            <input type="text" name="Fecha" value="{{ $venta->Fecha ?? '' }}" class="form-control" required style="text-transform: uppercase;">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="id_cliente">Nombre del Cliente</label>
                                            <select name="id_cliente" class="form-control" required>
                                                @foreach(\App\Models\Cliente::all() as $cliente)
                                                    <option value="{{ $cliente->id }}" {{ ($venta->id_cliente ?? '') == $cliente->id ? 'selected' : '' }}>
                                                        {{ $cliente->nombre_completo }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="id_producto">Producto</label>
                                            <select class="form-control" id="id_producto" name="id_producto">
                                                <option value="">Seleccionar Producto</option>
                                                @foreach ($productos as $producto)
                                                    <option value="{{ $producto->id }}" {{ ($venta->id_producto ?? '') == $producto->id ? 'selected' : '' }}>
                                                        {{ $producto->nombreproducto }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('id_producto')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="descripcion">Descripción</label>
                                            <input type="text" name="descripcion" value="{{ $venta->descripcion ?? '' }}" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="cantidad">Cantidad</label>
                                            <input type="number" name="cantidad" value="{{ $venta->cantidad ?? '' }}" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="id_medida">Medida</label>
                                            <select name="id_medida" class="form-control" required>
                                                <option value="">Seleccione una medida</option>
                                                @foreach(\App\Models\Medida::all() as $medida)
                                                    <option value="{{ $medida->id }}" {{ ($venta->id_medida ?? '') == $medida->id ? 'selected' : '' }}>
                                                        {{ $medida->nombremedida }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="totalpagado">Total Pagado</label>
                                            <input type="text" name="totalpagado" value="{{ $venta->totalpagado ?? '' }}" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="productos">Productos añadidos</label>
                                        <div id="productos-container">
                                            @if(isset($venta->productos))
                                                @foreach($venta->productos as $index => $detalleVenta)
                                                    <div class="producto-item">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="id_producto">Producto</label>
                                                                    <select name="productos[{{ $index }}][id_producto]" class="form-control" required>
                                                                        <option value="">Seleccionar Producto</option>
                                                                        @foreach ($productos as $producto)
                                                                            <option value="{{ $producto->id }}" {{ ($detalleVenta->id_producto ?? '') == $producto->id ? 'selected' : '' }}>
                                                                                {{ $producto->nombreproducto }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="cantidad">Cantidad</label>
                                                                    <input type="number" name="productos[{{ $index }}][cantidad]" value="{{ $detalleVenta->cantidad ?? '' }}" class="form-control" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="id_medida">Medida</label>
                                                                    <select name="productos[{{ $index }}][id_medida]" class="form-control" required>
                                                                        <option value="">Seleccione una medida</option>
                                                                        @foreach (\App\Models\Medida::all() as $medida)
                                                                            <option value="{{ $medida->id }}" {{ ($detalleVenta->id_medida ?? '') == $medida->id ? 'selected' : '' }}>
                                                                                {{ $medida->nombremedida }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="totalpagado">Total Pagado</label>
                                                                    <input type="number" name="productos[{{ $index }}][totalpagado]" value="{{ $detalleVenta->totalpagado ?? '' }}" class="form-control" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <button type="button" class="btn btn-danger remove-product" style="margin-top: 30px;">Eliminar Producto</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <button type="button" class="btn btn-primary" id="add-product">Agregar Producto</button>
                                    </div>
                                </div>

                                <hr class="mt-4">
                                <div class="row">
                                    <div class="col-md-12 text-left">
                                        <a href="{{ url('/ventas') }}" class="btn btn-secondary">Cancelar</a>
                                        <button type="submit" class="btn btn-success ml-2">Actualizar registro</button>
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
        let productIndex = {{ isset($venta->productos) ? count($venta->productos) : 0 }};

        document.getElementById('add-product').addEventListener('click', function() {
            const container = document.getElementById('productos-container');
            const newProductItem = document.createElement('div');
            newProductItem.classList.add('producto-item');
            newProductItem.innerHTML = `
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="id_producto">Producto</label>
                            <select name="productos[${productIndex}][id_producto]" class="form-control" required>
                                <option value="">Seleccionar Producto</option>
                                @foreach ($productos as $producto)
                                    <option value="{{ $producto->id }}">
                                        {{ $producto->nombreproducto }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="cantidad">Cantidad</label>
                            <input type="number" name="productos[${productIndex}][cantidad]" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="id_medida">Medida</label>
                            <select name="productos[${productIndex}][id_medida]" class="form-control" required>
                                <option value="">Seleccione una medida</option>
                                @foreach (\App\Models\Medida::all() as $medida)
                                    <option value="{{ $medida->id }}">
                                        {{ $medida->nombremedida }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="totalpagado">Total Pagado</label>
                            <input type="number" name="productos[${productIndex}][totalpagado]" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger remove-product" style="margin-top: 30px;">Eliminar Producto</button>
                    </div>
                </div>
            `;
            container.appendChild(newProductItem);

            // Agregar el evento de eliminar producto
            newProductItem.querySelector('.remove-product').addEventListener('click', function() {
                newProductItem.remove();
            });

            productIndex++;
        });
    </script>
@endsection