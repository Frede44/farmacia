<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @extends('dashboard.index')
    <title>Reporte</title>
    <link rel="stylesheet" href="{{ asset('css/productosEstilos/indexProductos.css') }}">
    <link rel="stylesheet" href="styles.css" />
    <script src="script.js"></script>
</head>

@section('contenido')

<div style="display: flex;">
    <div id="chartContainerProductos" style="height: 370px; width: 100%;"></div>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
</div>

<script>
    window.onload = function() {
        // Código para el gráfico de torta (productos más vendidos)
        var productos = @json($productosMasVendidos);
        var dataPointsProductos = productos.map(function(producto) {
            return {
                y: producto.total_vendido,
                label: producto.nombre
            };
        });

        var chartProductos = new CanvasJS.Chart("chartContainerProductos", {
            animationEnabled: true,
            title: {
                text: "Productos más vendidos"
            },
            data: [{
                type: "pie",
                startAngle: 240,
                indexLabel: "{label} {y}",
                dataPoints: dataPointsProductos
            }]
        });
        chartProductos.render();

        // Código para el gráfico de líneas
        var limit = 1000;
        var y = 0;
        var dataLine = []; // Renombrar para evitar conflicto con la variable 'data' del gráfico de torta si estuviera en el mismo scope global.
        var dataSeries = {
            type: "line"
        };
        var dataPointsLine = []; // Renombrar para evitar conflicto
        for (var i = 0; i < limit; i += 1) {
            y += (Math.random() * 10 - 5);
            dataPointsLine.push({
                x: i - limit / 2,
                y: y
            });
        }
        dataSeries.dataPoints = dataPointsLine;
        dataLine.push(dataSeries);

        var chartLine = new CanvasJS.Chart("chartContainer", { // Renombrar la variable del gráfico para evitar conflicto
            animationEnabled: true,
            zoomEnabled: true,
            title: {
                text: "Ventas por semana"
            },
            data: dataLine // Usar la variable renombrada
        });
        chartLine.render();
    }
</script>

<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

@endsection

</html>