<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @extends('dashboard.index')
    <title>Reporte</title>
    <link rel="stylesheet" href="{{ asset('css/reportesEstilos/estilos.css') }}">
    <link rel="stylesheet" href="styles.css" />
    <script src="script.js"></script>
</head>

@section('contenido')

<section class="titulos">
    <div>
        <h3>Reporte de Ventas</h3>
        <p>Análisis detallado del rendimiento de ventas</p>
    </div>
    <div class="filtros-acciones">
        <select id="rango-fechas">
            <option value="7">Últimos 7 días</option>
            <option value="30">Últimos 30 días</option>
            <option value="90">Últimos 3 meses</option>
            <option value="180">Últimos 6 meses</option>
            <option value="365">Último año</option>
        </select>

        <button class="btn-exportar" onclick="abrirModal()">
            <i class="fa-solid fa-download"></i> Exportar
        </button>
    </div>

    <!-- Modal flotante -->
    <div class="modal-exportar" id="modal-exportar">
        <div class="modal-contenido">
            <h3>¿En qué formato deseas exportar?</h3>
            <div class="botones-modal">
                <button onclick="exportarArchivo('pdf')">Exportar a PDF</button>
                <button onclick="exportarArchivo('excel')">Exportar a Excel</button>
            </div>
            <button class="cerrar" onclick="cerrarModal()">Cancelar</button>
        </div>
    </div>

</section>

<section class="section_card">
    <div class="card">
        <div class="card-title">
            <p>Ventas Totales</p>
            <i class="fa-solid fa-dollar-sign"></i>
        </div>
        <div class="card-content">

            <p id="total-ventas">0</p>
        </div>
    </div>

    <div class="card">
        <div class="card-title">
            <p>Productos Más Vendidos</p>
            <i class="fa-solid fa-box"></i>
        </div>
        <div class="card-content">

            <p id="productos-mas-vendidos">0</p>
        </div>

    </div>

    <div class="card">
        <div class="card-title">
            <p>Clientes Más Activos</p>
            <i class="fa-solid fa-user"></i>
        </div>
        <div class="card-content">

            <p id="clientes-mas-activos">0</p>
        </div>

    </div>

    <div class="card">
        <div class="card-title">
            <p>Total de compras</p>
            <i class="fa-solid fa-shopping-cart"></i>
        </div>
        <div class="card-content">
            <p id="total-compras">0</p>
        </div>
    </div>
</section>

<section class="opciones1">
    <div class="opcione active" id="opcion-resumen">
        <i class="fa-solid fa-chart-line"></i>
        <p>Resumen</p>
    </div>
    <div class="opcione" id="opcion-producto">
        <i class="fa-solid fa-chart-pie"></i>
        <p>Por Producto</p>
    </div>
    <div class="opcione" id="opcion-usuario">
        <i class="fa-solid fa-user"></i>
        <p>Por categoria</p>
    </div>
</section>


<section class="vista vista1 activa">
    <div class="grafico_uno">
        <div id="grafico-ventas" style="height: 370px; width: 100%;"></div>
    </div>
    <div class="grafico_dos">
        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    </div>

</section>

<section class="vista vista2">
    <div class="grafico_productos">
        <h3>📊 Productos Más Vendidos</h3>
        <p>Distribución de ventas por producto</p>
        <div id="grafico-productos" style="height: 370px; width: 100%;"></div>
    </div>

    <div class="grafico_contenido">
        <h4>Detalle de Productos</h4>
        <p>Ranking de productos por ventas</p>
        <div>
            <div class="producto">
                <div class="info">
                    <span class="color-dot" style="background-color: #3b82f6;"></span>
                    <div>
                        <strong>Producto Premium A</strong>
                        <p>234 ventas</p>
                    </div>
                </div>
                <div class="porcentaje">35%</div>
            </div>

            <div class="producto">
                <div class="info">
                    <span class="color-dot" style="background-color: #22c55e;"></span>
                    <div>
                        <strong>Producto Estándar B</strong>
                        <p>189 ventas</p>
                    </div>
                </div>
                <div class="porcentaje">28%</div>
            </div>

            <div class="producto">
                <div class="info">
                    <span class="color-dot" style="background-color: #a855f7;"></span>
                    <div>
                        <strong>Producto Básico C</strong>
                        <p>156 ventas</p>
                    </div>
                </div>
                <div class="porcentaje">23%</div>
            </div>

            <div class="producto">
                <div class="info">
                    <span class="color-dot" style="background-color: #f97316;"></span>
                    <div>
                        <strong>Producto Especial D</strong>
                        <p>94 ventas</p>
                    </div>
                </div>
                <div class="porcentaje">14%</div>
            </div>
        </div>
    </div>
</section>


<section class="vista vista3">
    <div class="categoria_conteiner">
        <h4>Ventas por categoria</h4>
        <p class="descripcion">Rendimiento de ventas agrupado por categorías de productos</p>
        <div class="categoria_contenido">

            <div class="categoria_item">
                <p class="numero">1</p>
                <div class="categoria_detalle">
                    <p class="nombre">pastillas</p>
                    <p class="cantidad">12 productos • 145 ventas</p>
                </div>
            </div>
            <div class="categoria_total">
                <p class="total">Q14.00</p>
                <p class="porcentaje">54% del total</p>
            </div>

        </div>

        <div class="categoria_contenido">

            <div class="categoria_item">
                <p class="numero">1</p>
                <div class="categoria_detalle">
                    <p class="nombre">pastillas</p>
                    <p class="cantidad">12 productos • 145 ventas</p>
                </div>
            </div>
            <div class="categoria_total">
                <p class="total">Q14.00</p>
                <p class="porcentaje">54% del total</p>
            </div>

        </div>
    </div>

</section>

<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

<script>
    const opciones = document.querySelectorAll('.opcione');

    opciones.forEach(opcion => {
        opcion.addEventListener('click', () => {
            opciones.forEach(o => o.classList.remove('active'));
            opcion.classList.add('active');
        });
    });
</script>

<script>
    const optionResumen = document.getElementById('opcion-resumen');
    const optionProducto = document.getElementById('opcion-producto');
    const optionUsuario = document.getElementById('opcion-usuario');

    function mostrarVista(nombreClase) {
        document.querySelectorAll('.vista').forEach(v => v.classList.remove('activa'));
        document.querySelector(`.${nombreClase}`).classList.add('activa');
    }

    optionResumen.addEventListener('click', () => mostrarVista('vista1'));
    optionProducto.addEventListener('click', () => mostrarVista('vista2'));
    optionUsuario.addEventListener('click', () => mostrarVista('vista3'));
</script>

<script>
    window.onload = function() {

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "light2", // "light1", "light2", "dark1", "dark2"
            title: {
                text: "Top Oil Reserves"
            },
            axisY: {
                title: "Reserves(MMbbl)"
            },
            data: [{
                type: "column",
                showInLegend: true,
                legendMarkerColor: "grey",
                legendText: "MMbbl = one million barrels",
                dataPoints: [{
                        y: 300878,
                        label: "Venezuela"
                    },
                    {
                        y: 266455,
                        label: "Saudi"
                    },
                    {
                        y: 169709,
                        label: "Canada"
                    },
                    {
                        y: 158400,
                        label: "Iran"
                    },
                    {
                        y: 142503,
                        label: "Iraq"
                    },
                    {
                        y: 101500,
                        label: "Kuwait"
                    },
                    {
                        y: 97800,
                        label: "UAE"
                    },
                    {
                        y: 80000,
                        label: "Russia"
                    }
                ]
            }]
        });
        chart.render();

        var chart = new CanvasJS.Chart("grafico-ventas", {
            animationEnabled: true,
            theme: "light2", // "light1", "light2", "dark1", "dark2"
            title: {
                text: "Top Oil Reserves"
            },
            axisY: {
                title: "Reserves(MMbbl)"
            },
            data: [{
                type: "column",
                showInLegend: true,
                legendMarkerColor: "grey",
                legendText: "MMbbl = one million barrels",
                dataPoints: [{
                        y: 300878,
                        label: "Venezuela"
                    },
                    {
                        y: 266455,
                        label: "Saudi"
                    },
                    {
                        y: 169709,
                        label: "Canada"
                    },
                    {
                        y: 158400,
                        label: "Iran"
                    },
                    {
                        y: 142503,
                        label: "Iraq"
                    },
                    {
                        y: 101500,
                        label: "Kuwait"
                    },
                    {
                        y: 97800,
                        label: "UAE"
                    },
                    {
                        y: 80000,
                        label: "Russia"
                    }
                ]
            }]
        });
        chart.render();

        var chart = new CanvasJS.Chart("grafico-productos", {
            animationEnabled: true,
            title: {

            },
            data: [{
                type: "pie",
                startAngle: 240,
                yValueFormatString: "##0.00\"%\"",
                indexLabel: "{label} {y}",
                dataPoints: [{
                        y: 79.45,
                        label: "Google"
                    },
                    {
                        y: 7.31,
                        label: "Bing"
                    },
                    {
                        y: 7.06,
                        label: "Baidu"
                    },
                    {
                        y: 4.91,
                        label: "Yahoo"
                    },
                    {
                        y: 1.26,
                        label: "Others"
                    }
                ]
            }]
        });
        chart.render();

    }
</script>

<script>
function abrirModal() {
  document.getElementById("modal-exportar").style.display = "flex";
}

function cerrarModal() {
  document.getElementById("modal-exportar").style.display = "none";
}

function exportarArchivo(tipo) {
  const rango = document.getElementById("rango-fechas").value;

  // Puedes redirigir al backend con los parámetros necesarios
  window.location.href = `/exportar?tipo=${tipo}&rango=${rango}`;
}
</script>



@endsection

</html>