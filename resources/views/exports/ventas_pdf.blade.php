<!DOCTYPE html>
<html>
<head>
    <title>Ventas PDF</title>
    <style>
        table { width: 100%; border-collapse: collapse; font-size: 12px; }
        th, td { border: 1px solid #000; padding: 4px; text-align: left; }
    </style>
</head>
<body>
    <h2>Reporte de Ventas</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Fecha</th>
                <th>Tipo</th>
                <th>Cantidad</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventas as $venta)
                <tr>
                    <td>{{ $venta->id }}</td>
                    <td>{{ $venta->producto->nombre }}</td>
                    <td>{{ $venta->created_at }}</td>
                    <td>{{ $venta->tipo_venta }}</td>
                    <td>{{ $venta->cantidad }}</td>
                    <td>{{ $venta->subtotal }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
