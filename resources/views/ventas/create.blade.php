@extends('layouts.admin')

@section('content')
<div class="content" style="margin-left: 10px">
    <h1 class="text-center"><b>Crear Nueva Venta</b></h1>

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
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"><b>Ingrese los datos de la venta</b></h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('ventas.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Fecha">Fecha</label>
                                    <input type="date" name="Fecha" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_cliente">Cliente</label>
                                    <select name="id_cliente" class="form-control select2-cliente" required>
                                        <option value="">Seleccione un Cliente</option>
                                        @foreach($clientes as $cliente)
                                            <option value="{{ $cliente->id }}">{{ $cliente->nombre_completo }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div id="productos-container">
                            {{-- Primer producto --}}
                            <div class="producto-item">
                                <div class="row mt-2">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Producto</label>
                                            <select name="productos[0][id_producto]" class="form-control select2-producto" required>
                                                <option value="">Seleccione un Producto</option>
                                                @foreach($productos as $producto)
                                                    <option value="{{ $producto->id }}">{{ $producto->nombreproducto }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Medida</label>
                                            <select name="productos[0][id_medida]" class="form-control" required>
                                                <option value="">Seleccione Medida</option>
                                                @foreach($medidas as $medida)
                                                    <option value="{{ $medida->id }}">{{ $medida->nombremedida }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Cantidad</label>
                                            <input type="number" name="productos[0][cantidad]" class="form-control" value="1" min="1" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Precio</label>
                                            <input type="number" name="productos[0][precio]" class="form-control" value="0.00" step="0.01" required>
                                        </div>
                                    </div>
                                    <div class="col-md-1" style="padding-top: 30px;">
                                        <button type="button" class="btn btn-danger remove-product">Eliminar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-primary mt-2" id="add-product">Agregar Producto</button>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-success">Registrar Venta</button>
                            <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Estilos y scripts --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function () {
        $('.select2-producto').select2({ placeholder: "Seleccione un Producto" });
        $('.select2-cliente').select2({ placeholder: "Seleccione un Cliente" });

        let productIndex = 1;

        $('#add-product').on('click', function () {
            const productoOptions = `@foreach($productos as $producto)<option value="{{ $producto->id }}">{{ $producto->nombreproducto }}</option>@endforeach`;
            const medidaOptions = `@foreach($medidas as $medida)<option value="{{ $medida->id }}">{{ $medida->nombremedida }}</option>@endforeach`;

            const newProduct = $(`
                <div class="producto-item">
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Producto</label>
                                <select name="productos[${productIndex}][id_producto]" class="form-control select2-producto" required>
                                    <option value="">Seleccione un Producto</option>
                                    ${productoOptions}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Medida</label>
                                <select name="productos[${productIndex}][id_medida]" class="form-control" required>
                                    <option value="">Seleccione Medida</option>
                                    ${medidaOptions}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Cantidad</label>
                                <input type="number" name="productos[${productIndex}][cantidad]" class="form-control" value="1" min="1" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Precio</label>
                                <input type="number" name="productos[${productIndex}][precio]" class="form-control" value="0.00" step="0.01" required>
                            </div>
                        </div>
                        <div class="col-md-1" style="padding-top: 30px;">
                            <button type="button" class="btn btn-danger remove-product">Eliminar</button>
                        </div>
                    </div>
                </div>
            `);

            $('#productos-container').append(newProduct);
            newProduct.find('.select2-producto').select2({ placeholder: "Seleccione un Producto" });

            productIndex++;
        });

        $(document).on('click', '.remove-product', function () {
            if ($('.producto-item').length > 1) {
                $(this).closest('.producto-item').remove();
            } else {
                alert('Debe haber al menos un producto en la venta.');
            }
        });
    });
</script>
@endsection
