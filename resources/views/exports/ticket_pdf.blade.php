<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket de Venta</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            color: #000;
            margin: auto;
        }

        .logo {
            text-align: center;
            margin-bottom: 10px;
        }

        .logo img {
            width: 80px;
        }

        .titulo {
            text-align: center;
            font-weight: bold;
            font-size: 18px;
            margin-top: 5px;
            margin-bottom: 10px;
        }

        .datos-ticket {
            font-size: 14px;
            margin-bottom: 10px;
        }

        .datos-ticket p {
            margin: 0;
        }

        table {
            width: 100%;
            font-size: 14px;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            text-align: left;
            padding: 4px 0;
        }

        th {
            border-bottom: 1px dashed #000;
            font-weight: bold;
        }

        .item-descripcion {
            display: block;
            font-size: 12px;
            color: #555;
        }

        .total, .footer {
            margin-top: 15px;
            font-size: 14px;
            text-align: right;
        }

        .footer {
            text-align: center;
            margin-top: 25px;
            font-size: 13px;
        }

        .footer p {
            margin: 4px 0;
        }
    </style>
</head>
<body>
    <div class="logo">
        <img src="farmaciasaludyahorro.com.gt/public/img/LocoFarmacia.png" alt="Logo">
    </div>

    <div class="titulo">FARMACIA SALUD & AHORRO</div>

    <div class="datos-ticket">
        <p><strong>Núm ticket:</strong> {{ sprintf('%05d', $venta->id) }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Cant.</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Importe</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventasDetalles as $detalle)
                <tr>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>
                        {{ $detalle->producto->nombre }}
                        @if ($detalle->producto->descripcion)
                            <span class="item-descripcion">{{ $detalle->producto->descripcion }}</span>
                        @endif
                    </td>
                    <td>Q{{ number_format($detalle->precio_unitario, 2) }}</td>
                    <td>Q{{ number_format($detalle->subtotal, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="datos-ticket">
        <p><strong>Número de artículos:</strong> {{ $ventasDetalles->sum('cantidad') }}</p>
    </div>

    <div class="total">
        <strong>Total: Q{{ number_format($venta->total, 2) }}</strong>
    </div>

    <div class="datos-ticket">
        <p><strong>Fecha:</strong> {{ $venta->created_at->format('d/m/Y') }}</p>
        <p><strong>Hora:</strong> {{ $venta->created_at->format('H:i') }}</p>
    </div>

    <div class="footer">
        <p>AGRADECEMOS SU PREFERENCIA</p>
        <p>VUELVA PRONTO!!!</p>
    </div>
</body>
</html>
