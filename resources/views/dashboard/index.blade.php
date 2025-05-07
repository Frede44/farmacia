<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmacia X</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <!-- Iconos-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

    <!-- Iconos-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

      <!--Diseño-->
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>


    <!-- Sidebar (Menú de la izquierda) -->
    <div class="sidebar">

    
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo">

        <ul>
            <li class="opciones"><a href="#"><i class="fas fa-home"></i><span>Inicio</span></a></li>
            @can('productos.index')

            <li class="opciones">
            <a href="{{ route('productos.index') }}" class="{{ request()->routeIs('productos.*') ? 'active' : '' }}">
                <i class="fas fa-pills"></i> Productos
            </a>
            </li>
            @endcan

            @can('categorias.index')
            <li class="opciones"><a href="{{ route('categorias.index')}}" class="{{ request()->routeIs('categorias.*') ? 'active' : '' }}">
                    <i class="fas fa-box"></i>Categorías</a></li>
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

            @can('persona.index')
            <li class="opciones"><a href="{{route('persona.index')}}"><i class="fas fa-users"></i>Personas</a></li>
            @endcan

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

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

    <!-- Inicialización -->
    <script>
        $(document).ready(function() {
            $('#tablaUsuarios').DataTable({
                dom: 'Bfrtip',
                //Botones de acciones de la tabla
                buttons: [{
                        extend: 'copyHtml5',
                        text: 'Copiar'
                    },
                    {
                        extend: 'excelHtml5',
                        text: 'Excel'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'PDF'
                    },

                ],

                pageLength: 10, // Fija la cantidad de registros a  mostrar
                lengthMenu: [5, 10, 25, 50, 100],
                responsive: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                    search: "Buscar:",
                    lengthMenu: "Mostrar _MENU_ registros",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                    paginate: {
                        previous: "Anterior",
                        next: "Siguiente"
                    },
                    zeroRecords: "No se encontraron resultados",
                    buttons: {
                        copyTitle: 'Copiado al portapapeles',
                        copySuccess: {
                            _: '%d filas copiadas',
                            1: '1 fila copiada'
                        }
                    }
                }

            });

        });
    </script>



</body>

</html>