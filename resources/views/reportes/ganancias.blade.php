<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
     <link rel="stylesheet" href="{{ asset('css/reportesEstilos/ganancias.css') }}">
      <link rel="icon" type="image/png" href="{{ asset('img/pestaña.png') }}">
      <link rel="icon" href="{{ asset('img/LocoFarmacia.png') }}" type="image/png">
     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
     <meta name="csrf-token" content="{{ csrf_token() }}">
    @extends('dashboard.index')
    <title>Reporte de ganancias</title>
</head>
<body>
    @section('contenido')
   <div class="container">
     <section class="filter-section">
        <div class="filter-group">
                <div class="filter-item">
                    <label for="filterType">Tipo de Filtro</label>
                    <select id="filterType">
                        <option value="day">Por Día</option>
                        <option value="month">Por Mes</option>
                        <option value="year">Por Año</option>
                        <option value="range">Rango de Fechas</option>
                    </select>
                </div>

                <div class="filter-item" id="dayFilter">
                    <label for="specificDate">Fecha Específica</label>
                    <input type="date" id="specificDate">
                </div>

                <div class="filter-item" id="monthFilter" style="display: none;">
                    <label for="monthSelect">Mes</label>
                    <select id="monthSelect">
                        <option value="1">Enero</option>
                        <option value="2">Febrero</option>
                        <option value="3">Marzo</option>
                        <option value="4">Abril</option>
                        <option value="5">Mayo</option>
                        <option value="6">Junio</option>
                        <option value="7">Julio</option>
                        <option value="8">Agosto</option>
                        <option value="9">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                    </select>
                </div>

                <div class="filter-item" id="yearFilter" style="display: none;">
                    <label for="yearSelect">Año</label>
                    <select id="yearSelect">
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                        <option value="2028">2028</option>
                        <option value="2029">2029</option>
                        <option value="2030">2030</option>
                    </select>
                </div>

                <div class="filter-item" id="startDateFilter" style="display: none;">
                    <label for="startDate">Fecha Inicio</label>
                    <input type="date" id="startDate">
                </div>

                <div class="filter-item" id="endDateFilter" style="display: none;">
                    <label for="endDate">Fecha Fin</label>
                    <input type="date" id="endDate">
                </div>
            </div>

            <div class="filter-buttons">
                 <button class="btn btn-primary" onclick="mandarDatosControlador()">Aplicar Filtros</button>
                <button class="btn btn-secondary" onclick="clearFilters()">Limpiar</button>
            </div>
        </div>
    </section>

     <section class="kpi-section">
        <div class="kpi-card">
            <h4>Ganancia Total</h4>
            <p id="ganancia-total">Q0.00</p>
        </div>
        <div class="kpi-card">
            <h4>Ventas Totales</h4>
            <p id="ventas-totales">Q0.00</p>
        </div>
        <div class="kpi-card">
            <h4>Cantidad Gastada en productos</h4>
            <p id="compras-totales">Q0.00</p>
        </div>
        <div class="kpi-card">
            <h4>Promedio de Ventas</h4>
            <p id="ticket-promedio">Q0.00</p>
        </div>
    </section>

    {{-- SECCIÓN DE GRÁFICAS --}}
    <section class="chart-section">
        <h3>Ganancias por Periodo</h3>
        <div style="width: 90%; margin: auto;">
            <canvas id="graficaGanancias"></canvas>
        </div>
    </section>
   </div>
</body>


<script>
   // Variable global para la instancia de la gráfica para poder destruirla y re-crearla
    let myChart;

    // --- MANEJO DE LA VISIBILIDAD DE FILTROS ---
    document.getElementById('filterType').addEventListener('change', function() {
        const filterType = this.value;
        
        // Ocultar todos los filtros específicos
        document.getElementById('dayFilter').style.display = 'none';
        document.getElementById('monthFilter').style.display = 'none';
        document.getElementById('yearFilter').style.display = 'none';
        document.getElementById('startDateFilter').style.display = 'none';
        document.getElementById('endDateFilter').style.display = 'none';
        
        // Mostrar filtros relevantes según la selección
        switch(filterType) {
            case 'day':
                document.getElementById('dayFilter').style.display = 'flex';
                break;
            case 'month':
                document.getElementById('monthFilter').style.display = 'flex';
                document.getElementById('yearFilter').style.display = 'flex';
                break;
            case 'year':
                document.getElementById('yearFilter').style.display = 'flex';
                break;
            case 'range':
                document.getElementById('startDateFilter').style.display = 'flex';
                document.getElementById('endDateFilter').style.display = 'flex';
                break;
        }
    });

    // --- FUNCIÓN PARA LIMPIAR FILTROS ---
    function clearFilters() {
        document.getElementById('specificDate').value = new Date().toISOString().split('T')[0];
        document.getElementById('monthSelect').value = '1';
        document.getElementById('yearSelect').value = '2025'; // Año actual
        document.getElementById('startDate').value = '';
        document.getElementById('endDate').value = '';
        document.getElementById('filterType').value = 'day';
        
        // Disparamos el evento 'change' para que la UI se actualice a la vista por día
        document.getElementById('filterType').dispatchEvent(new Event('change'));
        
        // Volvemos a cargar los datos con los filtros limpios
        mandarDatosControlador();
    }

    // --- FUNCIÓN PRINCIPAL PARA ENVIAR DATOS Y ACTUALIZAR UI ---
    function mandarDatosControlador(){
        const formData = new FormData();
        formData.append('filterType', document.getElementById('filterType').value);
        formData.append('specificDate', document.getElementById('specificDate').value);
        formData.append('monthSelect', document.getElementById('monthSelect').value);
        formData.append('yearSelect', document.getElementById('yearSelect').value);
        formData.append('startDate', document.getElementById('startDate').value);
        formData.append('endDate', document.getElementById('endDate').value);

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Muestra un indicador de carga si lo deseas
        // ej. document.getElementById('loader').style.display = 'block';

        fetch('/reporteGanancias', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json' // Es buena práctica indicar que esperas JSON
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('La respuesta del servidor no fue exitosa.');
            }
            return response.json();
        })
        .then(data => {
            console.log('Respuesta del servidor:', data);

            // 1. Actualizar las tarjetas de KPIs
            document.getElementById('ganancia-total').innerText = 'Q' + data.ganancias;
            document.getElementById('ventas-totales').innerText = 'Q' + data.totalVentas;
            document.getElementById('compras-totales').innerText = 'Q' + data.totalCompras;
            document.getElementById('ticket-promedio').innerText = 'Q' + data.ticketPromedio;

            // 2. Actualizar la gráfica
            const ctx = document.getElementById('graficaGanancias').getContext('2d');
            
            // Si ya existe una gráfica, la destruimos antes de crear una nueva
            if (myChart) {
                myChart.destroy();
            }

            myChart = new Chart(ctx, {
                type: 'bar', // Puedes cambiar a 'line' para ver la tendencia
                data: {
                    labels: data.grafica.labels,
                    datasets: [{
                        label: 'Ganancia por Día',
                        data: data.grafica.data,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                        borderRadius: 5, // Bordes redondeados para las barras
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                // Formatear el eje Y para que muestre 'Q'
                                callback: function(value, index, values) {
                                    return 'Q' + value;
                                }
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                // Formatear el tooltip para que muestre 'Q'
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed.y !== null) {
                                        label += 'Q' + context.parsed.y.toFixed(2);
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        })
        .catch(error => {
            console.error('Error al obtener los datos del reporte:', error);
            // Aquí podrías mostrar un mensaje de error al usuario en la UI
            alert('No se pudieron cargar los datos del reporte. Revisa la consola para más detalles.');
        })
        .finally(() => {
            // Oculta el indicador de carga
            // ej. document.getElementById('loader').style.display = 'none';
        });
    }

    // --- INICIALIZACIÓN ---
    // Al cargar la página, establece la fecha de hoy y carga los datos iniciales.
    document.addEventListener('DOMContentLoaded', function() {
        // Establecer la fecha actual en el input de día por defecto
        document.getElementById('specificDate').value = new Date().toISOString().split('T')[0];
        
        // Cargar los datos del día actual al entrar a la página
        mandarDatosControlador();
    });
</script>

@endsection

</html>