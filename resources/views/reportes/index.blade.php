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
            
            </div>
            <button class="cerrar" onclick="cerrarModal()">Cancelar</button>
        </div>
    </div>

</section>

<section class="section-card">
    <div class="card">
        <div class="card-title">
            <p>Ventas Totales</p>
            <i class="fa-solid fa-dollar-sign"></i>
        </div>
        <div class="card-content">
            @foreach ($cantidadVendida as $venta)
            <p class="value">Q{{ $venta->total_vendido }}</p>
            @endforeach
        </div>
    </div>

    <div class="card">
        <div class="card-title">
            <p>Número de Ventas</p>
            <i class="fa-solid fa-box"></i>
        </div>
        <div class="card-content">
            <p class="value">{{ $numeroVentas }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-title">
            <p>Ticket Promedio</p>
            <i class="fa-solid fa-chart-line"></i>
        </div>
        <div class="card-content">
            <p class="value">Q{{ number_format($promedioVentas, 2) }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-title">
            <p>Clientes Únicos</p>
            <i class="fa-solid fa-user-group"></i>
        </div>
        <div class="card-content">
            <p class="value">{{ $numeroProductos }}</p>
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
        <div id="grafico-ingresos" style="height: 370px; width: 100%;"></div>
    </div>

</section>

<section class="vista vista2">
    <div class="grafico_productos" style="display: flex; align-items: center; justify-content: center; flex-direction: column; gap: 20px;">
        <div class="grafico_tituloP" style="width: 100%;">
            <h3>📈 Ventas por Producto</h3>
            <p>Rendimiento de ventas agrupado por productos</p>


        </div>
        <div id="grafico-productos" style="height: 370px; width: 100%;"></div>
    </div>

    <!-- <div class="grafico_contenido">
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
    </div>-->
    <div class="grafico_contenido">
        <h4>Detalle de Productos</h4>
        <p>Ranking de productos por ventas</p>
        <div id="detalle-productos"></div>
    </div>
</section>


<section class="vista vista3">
    <div class="categoria_conteiner">
        <h4>Ventas por categoria</h4>
        <p class="descripcion">Rendimiento de ventas agrupado por categorías de productos</p>
    <div class="conteiner_categorias">
          @foreach ($categoriasMasVendidas as $index => $categoria)
        <div class="categoria_contenido">
            <div class="categoria_item">
                <p class="numero">{{ $index + 1 }}</p>
                <div class="categoria_detalle">
                    <p class="nombre">{{ $categoria->label }}</p>
                    <p class="cantidad">{{ $categoria->y }} productos </p>
                </div>
            </div>
            <div class="categoria_total">
                <p class="total">Q{{ number_format($categoria->total, 2) }}</p>
                <p class="porcentaje">{{ $categoria->porcentaje }}% del total</p>
            </div>
        </div>
        @endforeach
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

        var ventasPorDia = @json($ventasPorDia);

        var dias = ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'];
        var ventasData = [];
        var ingresosData = [];

        ventasPorDia.forEach(function(item) {
            let dia = new Date(item.created_at).getDay();
            ventasData.push({
                label: item.dia.substring(0, 3),
                y: parseInt(item.ventas)
            });
            ingresosData.push({
                label: item.dia.substring(0, 3),
                y: parseFloat(item.ingresos)
            });
        });

        // Gráfico de Ventas
        var chartVentas = new CanvasJS.Chart("grafico-ventas", {
            animationEnabled: true,
            theme: "light2",
            title: {
                text: "Ventas por Día"
            },
            axisY: {
                lineThickness: 0, // Oculta la línea del eje Y
                tickLength: 0, // Elimina las marcas de las divisiones
                labelFormatter: function() {
                    return "";
                }, // Elimina los números (etiquetas)
                gridThickness: 0 // Elimina las líneas horizontales del grid
            },
            data: [{
                type: "column",
                color: "#4285F4", // azul
                indexLabel: "{y}",
                dataPoints: ventasData
            }]
        });
        chartVentas.render();

        // Gráfico de Ingresos
        var chartIngresos = new CanvasJS.Chart("grafico-ingresos", {
            animationEnabled: true,
            theme: "light2",
            title: {
                text: "Ingresos por Día"
            },
            axisY: {
                lineThickness: 0, // Oculta la línea del eje Y
                tickLength: 0, // Elimina las marcas de las divisiones
                labelFormatter: function() {
                    return "";
                }, // Elimina los números (etiquetas)
                gridThickness: 0 // Elimina las líneas horizontales del grid
            },
            data: [{
                type: "column",
                color: "#34A853", // verde
                indexLabel: "{y}",
                dataPoints: ingresosData
            }]
        });
        chartIngresos.render();

        var productosMasVendidos = @json($productosMasVendidos);

        // Colores que usaremos, en el mismo orden que los productos
        var colores = ["#3b82f6", "#22c55e", "#a855f7", "#f97316"];

        // Asignar color a cada producto
        productosMasVendidos.forEach((producto, index) => {
            producto.color = colores[index % colores.length]; // por si hay más productos que colores
        });

        // Crear la gráfica con los colores asignados
        var chart = new CanvasJS.Chart("grafico-productos", {
            animationEnabled: true,
            title: {},
            data: [{
                type: "pie",
                startAngle: 240,
                yValueFormatString: "#,##0 unidades",
                showInLegend: true,
                dataPoints: productosMasVendidos
            }]
        });
        chart.render();

        // Generar HTML dinámico con los mismos datos
        var detalleContainer = document.getElementById("detalle-productos");

        productosMasVendidos.forEach((producto) => {
            let porcentaje = ((producto.y / productosMasVendidos.reduce((acc, p) => acc + p.y, 0)) * 100).toFixed(0);

            let item = `
        <div class="producto">
            <div class="info">
                <span class="color-dot" style="background-color: ${producto.color};"></span>
                <div>
                    <strong>${producto.label}</strong>
                    <p>${producto.y} ventas</p>
                </div>
            </div>
            <div class="porcentaje">${porcentaje}%</div>
        </div>
    `;
            detalleContainer.innerHTML += item;
        });


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