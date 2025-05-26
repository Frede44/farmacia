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
    <h3>Reporte de Ventas</h3>
    <p>Análisis detallado del rendimiento de ventas</p>
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
        <p>Por Usuario</p>
    </div>
</section>


<section class="vista vista1 activa">
    <div>Contenido de Resumen</div>
</section>

<section class="vista vista2">
    <div>Contenido de Producto</div>
</section>

<section class="vista vista3">
    <div>Contenido de Usuario</div>
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


@endsection

</html>