<div class="table-responsive">
    <h5>Cliente: <strong>{{ $venta->cliente->nombre }}</strong></h5>
    <p>Fecha: {{ \Carbon\Carbon::parse($venta->Fecha)->format('d/m/Y H:i') }}</p>

    <table class="table table-bordered table-hover">
        <thead class="table-primary">
            <tr>
                <th>Producto</th>
                <th>Medida</th>
                <th class="text-end">Cantidad</th>
                <th class="text-end">Precio</th>
                <th class="text-end">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($venta->detalleVentas as $detalle)
                <tr>
                    <td>{{ $detalle->producto->nombre }}</td>
                    <td>{{ $detalle->medida->nombre }}</td>
                    <td class="text-end">{{ $detalle->cantidad }}</td>
                    <td class="text-end">{{ number_format($detalle->precio, 2) }}</td>
                    <td class="text-end">{{ number_format($detalle->cantidad * $detalle->precio, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-3">
        <h5>Total Pagado: <strong>Bs {{ number_format($venta->totalpagado, 2) }}</strong></h5>
    </div>
</div>
