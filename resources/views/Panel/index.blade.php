@extends('dashboard.index')

<link rel="stylesheet" href="{{ asset('css/panelEstilos/indexPanel.css') }}">

@section('contenido')
<div class="titulo">
    <h1>Panel de Control</h1>
    <p>Bienvenido de vuelta, aquí tienes un resumen de tu negocio</p>
</div>

<div class="acciones_rapidas">
    <div class="acciones_titulo">
        <h3>Acciones rapidas</h3>
        <p>Accede rápidamente a las funciones más utilizadas</p>
    </div>

    <div class="conteiner-card">
        <a href="{{ route('ventas.create') }}" style="text-decoration: none;">
            <div class="card venta">
                <div class="card-icon">
                    <i class="fa-solid fa-cart-shopping" style="color: rgb(50, 131, 245); "></i>
                </div>
                <div class="card-text">
                    <p>Nuevas Ventas</p>

                </div>

            </div>
        </a>

        <a href="{{ route('productos.index') }}" style="text-decoration: none;">
            <div class="card producto">
                <div class="card-icon">
                    <i class="fa-solid fa-box" style="color: rgb(82, 174, 48); "></i>
                </div>
                <div class="card-text">
                    <p>Productos</p>

                </div>

            </div>
        </a>

        <a href="{{ route('inventario.index') }}" style="text-decoration: none;">
            <div class="card inventario">
                <div class="card-icon">
                    <i class="fa-solid fa-warehouse" style="color: rgb(245, 131, 50); "></i>
                </div>
                <div class="card-text">
                    <p>Inventario</p>

                </div>

            </div>
        </a>

        <a href="{{ route('reportes.index') }}" style="text-decoration: none;">
            <div class="card reporte">
                <div class="card-icon">
                    <i class="fa-solid fa-chart-pie" style="color: rgb(138, 50, 245); "></i>
                </div>
                <div class="card-text">
                    <p>Reportes</p>

                </div>

            </div>
        </a>

        <a href="{{ route('usuarios.index') }}" style="text-decoration: none;">
            <div class="card usuario">

                <div class="card-icon">
                    <i class="fa-solid fa-user" style="color: rgb(39, 92, 240); "></i>
                </div>
                <div class="card-text">
                    <p>Usuarios</p>
                </div>


            </div>
        </a>
        <a href="{{ route('compras.index') }}" style="text-decoration: none;">
            <div class="card compra">
                <div class="card-icon">
                    <i class="fa-solid fa-plus" style="color: rgb(31, 178, 134);"></i>
                </div>
                <div class="card-text">
                    <p>Compras</p>

                </div>

            </div>
        </a>


    </div>
</div>

<div class="resumen">
    <div class="ventas-graficas">
        <div id="chartContainer" style="height: 100%; width: 100%;"></div>
    </div>
    <div class="ventas-recientes">
        <h3>Ventas recientes </h3>
        <p>Ultimas ventas realizadas</p>

        @foreach ($ventasRecientes as $venta)
        <div class="ventas-recientes-contenido">
            <div class="ventas-datos">
                <div class="ventas-datos-imagen">
                    {{
        collect(explode(' ', $venta->cliente->nombre))
            ->take(2)
            ->map(fn($n) => strtoupper(substr($n, 0, 1)))
            ->implode('')
            }}
                </div>
                <div class="ventas-datos-nombre">
                    <p>{{ $venta->cliente->nombre }}</p>
                    <span>Hace {{ $venta->created_at->diffInMinutes() }} min</span>
                </div>
            </div>

            <div class="ventas-datos-precio">
                <span>Q.{{ $venta->total }}</span>
                <p>Completada</p>
            </div>
        </div>
        @endforeach

        <div class="ventas-recientes-vermas">
            <a href="{{ route('ventas.index') }}">Ver todas las ventas <i class="fa-solid fa-arrow-right"></i></a>
        </div>
    </div>
</div>

@php
function calcularColor($dias) {
$dias = max(0, min($dias, 30)); // Limita a un rango de 0 a 30 días
$rojo = 255;
$verde_azul = intval(255 * ($dias / 30)); // Menos días => más rojo
return "rgb($rojo, $verde_azul, $verde_azul)";
}
@endphp

<div class="productos">
    <div class="productos-destacados">
        <h3>Productos por vencer</h3>
        <p>Los productos que están por vencer</p>

        <div class="productos-destacados-contenedor">
            @foreach ($productosPorVencer as $producto)
            <div class="productos-destacados-contenido">
                <div class="productos-destacados-numero" style="background-color: {{ calcularColor($producto->dias_restantes) }};">
                    {{ $loop->iteration }}
                </div>
                <div class="productos-destacados-nombre">
                    <p>{{ $producto->producto->nombre }}</p>
                    <span>{{ $producto->caducidad }} </span>
                </div>

            </div>
            @endforeach
        </div>
    </div>
    <div class="productos-inventario">
        <h3>Alerta de inventario</h3>
        <p>Productos con bajo stock</p>
         
        @foreach ($productosBajoStock as $producto)
        <div class="conteiner-invetario">

            <div class="datos">
                <div class="datos-producto">
                    <p>Producto 1</p>
                    <span>Stock actual: 21</span>
                </div>
                <div class="datos-categoria">
                    <p>Jarabe</p>
                    <span>Minimo 100</span>
                </div>
            </div>
            <div class="progress-container">
                <div class="progress-bar"></div>
            </div>

        </div>
        @endforeach
        <div class="inventario-gestionar">
            <a href="{{ route('inventario.index') }}">Gestionar inventario<i class="fa-solid fa-arrow-right"></i></a>
        </div>
    </div>
</div>




<script>
    window.onload = function() {
        // Recibes los datos directamente formateados desde Laravel
        // Asegúrate que la variable $ventasPorDiaSemana esté disponible y sea un JSON válido
        var dataPointsSemana = @json($ventasParaGrafico ?? []); // Usa '?? []' para evitar error si la variable no está definida

        console.log("Data Points Semana:", dataPointsSemana); // Verifica los datos que estás recibiendo
        if (dataPointsSemana.length === 0) {
            console.log("No hay datos de ventas para la semana actual para mostrar en el gráfico.");
            // Opcionalmente, puedes mostrar un mensaje en el contenedor del gráfico
            document.getElementById("chartContainerVentasSemana").innerHTML = "<p style='text-align:center;padding-top:50px;'>No hay datos de ventas para mostrar para la semana actual.</p>";
            return; // No renderizar el gráfico si no hay datos
        }

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "light2", // Puedes cambiar el tema (ej: "light1", "dark1", "dark2")
            title: {
                text: "Ventas de la Semana Actual"
            },
            axisX: {
                title: "Día de la Semana",
                // Las etiquetas (labels) ya vienen como "Lunes", "Martes", etc.
                // No es necesario `labelAngle` a menos que los nombres sean muy largos o se solapen
                interval: 1, // Para asegurar que se muestren todas las etiquetas de los días
                gridThickness: 0 // Esto elimina las líneas verticales
            },
            axisY: {


                includeZero: true,
                gridThickness: 0,
                lineThickness: 0,
                labelFormatter: function() {
                    return ""; // Oculta los valores del eje Y
                }
            },
            data: [{
                type: "column", // Tipo de gráfico: "column", "bar", "line", "area", etc.
                indexLabel: "Q{y}", // Muestra el valor 'y' sobre cada columna
                indexLabelFontSize: 12,
                indexLabelPlacement: "outside", // Posición del valor ("inside" o "outside")
                indexLabelFontColor: "#333333", // Color del texto del valor
                toolTipContent: "<strong>{label}</strong>: ${y}", // Contenido del tooltip al pasar el mouse
                dataPoints: dataPointsSemana
                // dataPointsSemana ya tiene el formato:
                // [
                //   { label: "Lunes", y: 150.50 },
                //   { label: "Martes", y: 0 },
                //   ...
                // ]
            }]
        });

        chart.render();




        ///

        // Valores que puedes cambiar dinámicamente
        const stockActual = 21;
        const stockMinimo = 100;

        // Actualiza el texto
        document.getElementById("stock-actual").innerText = `Stock actual: ${stockActual}`;
        document.getElementById("stock-minimo").innerText = `Mínimo: ${stockMinimo}`;

        // Calcula el porcentaje (con tope al 100%)
        const porcentaje = Math.min((stockActual / stockMinimo) * 100, 100);
        console.log("Porcentaje de stock:", porcentaje);

        // Aplica el ancho a la barra
        document.getElementById("progress-bar").style.width = porcentaje + "%";
    }
</script>




<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
@endsection