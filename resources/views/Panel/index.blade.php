@extends('dashboard.index')

<link rel="stylesheet" href="{{ asset('css/panelEstilos/indexPanel.css') }}">

@section('contenido')
<h1>Panel de control</h1>

<div class="card-container">
    <div class="card">
        <div class="card-title">
            <h3>Ventas Totales</h3>
            <i class="fa-solid fa-money-bill-wave"></i>
        </div>
        <div class="card-content">
            <p>$45,231.89</p>
            <small>+20.1% del mes pasado</small>
        </div>
    </div>
    <div class="card">
        <div class="card-title">
            <h3>Productos</h3>
            <i class="fa-solid fa-box"></i>
        </div>
        <div class="card-content">
            <p>2,345</p>
            <small>+180 nuevos productos</small>
        </div>
    </div>
    <div class="card">
        <div class="card-title">
            <h3>Clientes</h3>
            <i class="fa-solid fa-users"></i>
        </div>
        <div class="card-content">
            <p>+573</p>
            <small>+201 esta semana</small>
        </div>
    </div>
    <div class="card">
        <div class="card-title">
            <h3>Ventas Activas</h3>
            <i class="fa-solid fa-chart-line"></i>
        </div>
        <div class="card-content">
            <p>+12,234</p>
            <small>+19% del mes pasado</small>
        </div>
    </div>
</div>

<div class="conteiner-grafica">
    <div class="grafica">

        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    </div>
<div class="inventario">
    <h2>Inventario Bajo</h2>
    <p>Productos que necesitan reabastecimiento</p>
    <ul>
        <li>
            <div class="producto">
                <strong class="low">Paracetamol 500mg</strong>
                <span class="cantidad">Quedan 5 unidades</span>
            </div>
        </li>
        <li>
            <div class="producto">
                <strong class="low">Ibuprofeno 400mg</strong>
                <span class="cantidad">Quedan 8 unidades</span>
            </div>
        </li>
        <li>
            <div class="producto">
                <strong class="medium">Amoxicilina 500mg</strong>
                <span class="cantidad">Quedan 12 unidades</span>
            </div>
        </li>
        <li>
            <div class="producto">
                <strong class="medium">Loratadina 10mg</strong>
                <span class="cantidad">Quedan 15 unidades</span>
            </div>
        </li>
    </ul>
</div>



<div class="recordatorios">
    <h2>Recordatorio</h2>

    <div>

        <p>Hay 3 medicamentos que vencen en los próximos 30 días. Revise la sección de inventario.</p>
    </div>
</div>



<script>
    window.onload = function() {

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "light2",
            title: {
                text: "Resumen de Ventas"
            },
            data: [{
                type: "line",
                indexLabelFontSize: 16,
                dataPoints: [{
                        y: 450
                    },
                    {
                        y: 414
                    },
                    {
                        y: 520,
                        indexLabel: "\u2191 highest",
                        markerColor: "red",
                        markerType: "triangle"
                    },
                    {
                        y: 460
                    },
                    {
                        y: 450
                    },
                    {
                        y: 500
                    },
                    {
                        y: 480
                    },
                    {
                        y: 480
                    },
                    {
                        y: 410,
                        indexLabel: "\u2193 lowest",
                        markerColor: "DarkSlateGrey",
                        markerType: "cross"
                    },
                    {
                        y: 500
                    },
                    {
                        y: 480
                    },
                    {
                        y: 510
                    }
                ]
            }]
        });
        chart.render();

    }
</script>

<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
@endsection