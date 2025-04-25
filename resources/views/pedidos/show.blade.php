@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 20px">
        <h1 class="text-center"><b>Detalles del Pedido</b></h1><br>

        <div class="row">
            <div class="col-md-11">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><b>Información del Pedido</b></h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fecha">Fecha</label>
                                    <input type="date" name="fecha" value="{{ $pedido->fecha }}" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="id_proveedor">Proveedor</label>
                                    <input type="text" name="id_proveedor" value="{{ $pedido->proveedor->nombreproveedor ?? 'Proveedor no asignado' }}" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="telefono">Teléfono</label>
                                    <input type="text" name="telefono" value="{{ $pedido->telefono }}" class="form-control" disabled>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="card-header">
                            <h3 class="card-title"><b>Productos del Pedido</b></h3>
                        </div>
                        <div class="card-body">
                            @if ($pedido->detallesPedido->isNotEmpty())
                                <table class="table table-bordered table-striped table-sm">
                                    <thead class="bg-info text-white">
                                        <tr>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pedido->detallesPedido as $detalle)
                                            <tr>
                                                <td>{{ $detalle->producto->nombreproducto }}</td>
                                                <td>{{ $detalle->cantidad }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p>No se encontraron productos para este pedido.</p>
                            @endif
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <a href="{{ url('/pedidos') }}" class="btn btn-secondary">Atrás</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection