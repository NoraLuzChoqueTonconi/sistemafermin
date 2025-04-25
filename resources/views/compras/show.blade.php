@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 20px">
        <h1 class="text-center"><b>Detalles de la Compra</b></h1><br>

        <div class="row">
            <div class="col-md-11">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><b>Información de la Compra</b></h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fecha">Fecha</label>
                                    <input type="text" name="fecha" value="{{ $compra->fecha }}" class="form-control" disabled>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="proveedor">Proveedor</label>
                                    <input type="text" name="proveedor" value="{{ $compra->proveedor->nombreproveedor }}" class="form-control" disabled>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="usuario">Usuario</label>
                                    <input type="text" name="usuario" value="{{ $compra->user->name }}" class="form-control" disabled>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <h3>Detalles de los Productos Comprados</h3>
                        <table class="table table-bordered table-striped">
                            <thead class="bg-info text-white">
                                <tr>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio Compra Unitario</th>
                                    <th>Precio Venta Unitario</th>
                                    <th>Descripción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($compra->detallesCompra->isNotEmpty())
                                    @foreach ($compra->detallesCompra as $detalle)
                                        <tr>
                                            <td>{{ $detalle->producto->nombreproducto }}</td>
                                            <td>{{ $detalle->cantidad }}</td>
                                            <td>{{ $detalle->precio_unitario }}</td>
                                            <td>{{ $detalle->producto->precioventa }}</td> {{-- Asumiendo que el precio de venta está en la tabla de productos --}}
                                            <td>{{ $detalle->descripcion ?? 'Sin descripción' }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td colspan="5" class="text-center">No hay productos en esta compra.</td></tr>
                                @endif
                            </tbody>
                        </table>

                        <hr>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-gro">
                                    <a href="{{ route('compras.index') }}" class="btn btn-secondary">Atrás</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection