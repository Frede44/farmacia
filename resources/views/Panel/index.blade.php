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
            
            <p>Q{{$ventaActual}}</p>
        
            <small>+{{$porcentaje}}% del mes pasado</small>
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
        var ventasData = @json($ventasPorMes);

        // Opcional: convertir "2025-05" a "Mayo 2025"
        function formatPeriodo(periodo) {
            const meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                           'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
            const [year, month] = periodo.split('-');
            return `${meses[parseInt(month) - 1]} ${year}`;
        }

        var dataPoints = ventasData.map(function(item) {
            return {
                label: formatPeriodo(item.periodo),
                y: parseFloat(item.total)
            };
        });

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "light2",
            title: {
                text: "Resumen de Ventas por Mes"
            },
            axisX: {
                labelAngle: -45
            },
            data: [{
                type: "column", // Puedes cambiar a "line"
                indexLabelFontSize: 14,
                dataPoints: dataPoints
            }]
        });

        chart.render();
    }
</script>


<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
@endsection