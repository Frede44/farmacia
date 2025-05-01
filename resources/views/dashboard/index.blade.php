<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmacia X</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <!-- Iconos-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>


    <!-- Sidebar (Menú de la izquierda) -->
    <div class="sidebar">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo">

        <ul>
            <li class="opciones"><a href="#"><i class="fas fa-home"></i>Inicio</a></li>
            @can('productos.index')
            <li class="opciones"><a href="{{ route('productos.index') }}" class="{{ request()->routeIs('productos')? 'active' : '' }}">
                    <i class="fas fa-pills"></i>Productos</a></li>
            @endcan

            @can('categorias.index')
            <li class="opciones"><a href="{{ route('categorias.index')}}" class="{{ request()->routeIs('categorias') ? 'active' : '' }}">
                    <i class="fas fa-box"></i>Categorias</a></li>
            @endcan

            @can('inventario.index')
            <li class="opciones"><a href="{{ route('inventario.index')}}" class="{{ request()->routeIs('inventario') ? 'active' : '' }}">
                    <i class="fas fa-list"></i>Inventario</a></li>
            @endcan
            <li class="opciones"><a href="#"><i class="fas fa-shopping-bag"></i>Venta</a></li>

            <li class="opciones"><a href="#"><i class="fas fa-chart-line"></i>Reporte de ventas</a></li>

            <li class="opciones"><a href="#"><i class="fas fa-shopping-cart"></i>Compra</a></li>

            <li class="opciones"><a href="#"><i class="fas fa-building"></i>Proveedor</a></li>

            <li class="opciones"><a href="#"><i class="fas fa-box"></i>Inventario por lote</a></li>

            <li class="opciones"><a href="#"><i class="fas fa-users"></i>Personas</a></li>

            @can('usuarios.index')
            <li class="opciones"><a href="{{ route('usuarios.index') }}"><i class="fas fa-user"></i>Usuarios</a></li>
            @endcan
         
            @can('rol.index')
            <li class="opciones"><a href="{{ route('rol.index') }}"><i class="fa-solid fa-users-gear"></i>Roles</a></li>
            @endcan
            <li class="opciones"><a href="{{ route('logout.store') }}"><i class="fas fa-sign-out-alt"></i>Cerrar Sesión</a></li>
        </ul>
    </div>


    <!-- Vistas o opciones mas el sidebar -->
    <div class="vistas">
        @yield('contenido')
    </div>


    <script>
        // funcion para abrir y cerrar el sidebar en pantallas pequeñas
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('open');
        }
    </script>

    <script>
        //Mantener seleccionado las opciones
        document.querySelectorAll('.sidebar a').forEach(link => {
            link.addEventListener('click', function() {
                // quitar clase activa de todos los enlaces
                document.querySelectorAll('.sidebar a').forEach(el => el.classList.remove('active'));

                // agregar clase activa al enlace al hacer click
                this.classList.add('active');
            });
        });
    </script>



</body>

</html>