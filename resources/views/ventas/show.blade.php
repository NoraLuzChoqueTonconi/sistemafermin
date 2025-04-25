<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle de Venta #{{ $venta->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            position: relative;
        }

        .logo-fondo {
            position: absolute;
            top: 100px;
            left: 50%;
            transform: translateX(-50%);
            width: 400px;
            opacity: 0.05;
            z-index: 0;
        }

        .encabezado {
            text-align: center;
            z-index: 2;
            position: relative;
        }

        .encabezado h2 {
            margin: 0;
            font-size: 32px;
            color: #333;
        }

        .datos-venta {
            margin-top: 30px;
            margin-bottom: 30px;
            z-index: 2;
            position: relative;
        }

        .datos-venta th, .datos-venta td {
            padding: 5px 10px;
            text-align: left;
        }

        table.detalles {
            width: 100%;
            border-collapse: collapse;
            z-index: 2;
            position: relative;
        }

        table.detalles th, table.detalles td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        .totales {
            margin-top: 20px;
            text-align: right;
            font-size: 18px;
            z-index: 2;
            position: relative;
        }

        @media print {
            .logo-fondo {
                position: fixed;
            }
        }
    </style>
</head>
<body>

    {{-- Logo de fondo --}}
    <img src="{{ public_path('storage/ferreteria-logo.jpg') }}" alt="Logo Ferretería Fermín" class="logo-fondo">

    {{-- Encabezado --}}
    <div class="encabezado">
        <h2>FERRETERÍA FERMIN</h2>
        <p><strong>Detalle de Venta</strong></p>
    </div>

    {{-- Información de la venta --}}
    <div class="datos-venta">
        <table>
            <tr>
                <th>Fecha:</th>
                <td>{{ $venta->Fecha }}</td>
            </tr>
            <tr>
                <th>Cliente:</th>
                <td>{{ $venta->cliente->nombre_completo }}</td>
            </tr>
            <tr>
                <th>ID Venta:</th>
                <td>{{ $venta->id }}</td>
            </tr>
        </table>
    </div>

    {{-- Detalle de productos --}}
    <table class="detalles">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Medida</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($venta->detalleVentas as $detalle)
                <tr>
                    <td>{{ $detalle->producto->nombre }}</td>
                    <td>{{ $detalle->medida->nombre }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>{{ number_format($detalle->precio, 2) }}</td>
                    <td>{{ number_format($detalle->cantidad * $detalle->precio, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Total --}}
    <div class="totales">
        <h3>Total Pagado: Bs {{ number_format($venta->totalpagado, 2) }}</h3>
    </div>

    {{-- Impresión automática --}}
    <script>
        window.onload = function() {
            window.print();
        };
    </script>

</body>
</html>
