<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmacia X</title>
    <link rel="icon" href="{{ asset('img/LocoFarmacia.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    
    <!-- jQuery -->
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <!-- Iconos-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

    <!-- Iconos-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!--Diseño-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!--datatable-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css" />
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

    

    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('js/select2.min.js') }}"></script>
</head>

<body>



     <button id="btnToggleSidebar" class="btn-toggle-sidebar">
        <i class="fas fa-bars"></i>
    </button>
   

    <!-- Sidebar (Menú de la izquierda) -->
    <div class="sidebar">


        <img src="{{ asset('img/LocoFarmacia.png') }}" alt="Logo" class="logo">

        <ul>
            <li class="opciones"><a href="{{route('panel.index')}}"><i class="fas fa-home"></i><span>Inicio</span></a></li>
            @can('productos.index')

            <li class="opciones">
                <a href="{{ route('productos.index') }}" class="{{ request()->routeIs('productos.*') ? 'active' : '' }}">
                    <i class="fas fa-pills"></i>Productos
                </a>
            </li>
            @endcan

            @can('categorias.index')
            <li class="opciones"><a href="{{ route('categorias.index')}}" class="{{ request()->routeIs('categorias.*') ? 'active' : '' }}">
                    <i class="fas fa-box"></i>Presentaciones</a></li>
            @endcan

            @can('inventario.index')
            <li class="opciones"><a href="{{ route('inventario.index')}}" class="{{ request()->routeIs('inventario.*') ? 'active' : '' }}">
                    <i class="fas fa-list"></i>Inventario</a></li>
            @endcan

            @can('ventas.index')
            <li class="opciones"><a href="{{route('ventas.index')}}" class="{{ request()->routeIs('ventas.*') ? 'active' : '' }}"><i class="fas fa-shopping-bag"></i>Venta</a></li>
            @endcan

            @can('reportes.index')
            <li class="opciones"><a href="{{route('reportes.index')}}" class="{{ request()->routeIs('reportes.*') ? 'active' : '' }}"><i class="fas fa-chart-line"></i>Reporte de ventas</a></li>
            @endcan

            @can('compras.index')
            <li class="opciones"><a href="{{route('compras.index')}}" class="{{ request()->routeIs('compras.*') ? 'active' : '' }}"><i class="fas fa-shopping-cart"></i>Compra</a></li>
            @endcan

            @can('proveedor.index')
            <li class="opciones"><a href="{{ route('proveedor.index')}}" class="{{ request()->routeIs('proveedor.*') ? 'active' : '' }}">
                    <i class="fas fa-building"></i>Proveedor</a></li>
            @endcan





            @can('persona.index')
            <li class="opciones"><a href="{{route('persona.index')}}" class="{{ request()->routeIs('persona.*') ? 'active' : '' }}"><i class="fas fa-users"></i>Personas</a></li>
            @endcan

            @can('usuarios.index')
            <li class="opciones"><a href="{{ route('usuarios.index') }} " class="{{ request()->is('usuarios*') || request()->is('register') ? 'active' : '' }}"><i class="fas fa-user"></i>Usuarios</a></li>
            @endcan

            @can('rol.index')
            <li class="opciones"><a href="{{ route('rol.index') }}" class="{{ request()->routeIs('rol.*') ? 'active' : '' }}"><i class="fa-solid fa-users-gear"></i>Roles</a></li>
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


    <!--Mensaje cuando se guarda correctamente-->
    @if (session('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar'
            });
        });
    </script>
    @endif
    <!--Mensaje cuando se cancela correctamente-->
    @if(request()->has('cancelado'))
    <script>
        Swal.fire({
            icon: 'info',
            title: 'Cancelado',
            text: 'La operación fue cancelada correctamente',
            confirmButtonText: 'Aceptar',
            confirmButtonColor: 'rgb(38, 128, 189)',
        });
    </script>
    @endif
    <script>
        function confirmarEliminacion(event, elemento) {
            event.preventDefault();
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡Esta acción no se puede deshacer!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    elemento.closest('form').submit();
                }
            });
        }
    </script>

    <!-- Contador de descripción -->
    <script>
        function actualizarContadorDescripcion() {
            const textarea = document.getElementById('descripcion');
            const contador = document.getElementById('contador');
            if (!textarea || !contador) return; // Verificación por si los elementos no existen

            const restante = 250 - textarea.value.length;

            if (restante < 0) {
                contador.style.color = 'red';
                contador.textContent = `Te has pasado por ${Math.abs(restante)} caracteres`;
            } else {
                contador.style.color = '#666';
                contador.textContent = `Quedan ${restante} caracteres`;
            }
        }
        // Inicializar al cargar
        document.addEventListener('DOMContentLoaded', () => {
            actualizarContadorDescripcion();

            const textarea = document.getElementById('descripcion');
            if (textarea) {
                textarea.addEventListener('input', actualizarContadorDescripcion);
            }
        });
    </script>

    <!-- Contador de nombre-->

    <script>
        function actualizarContador(inputId, contadorId, maxLength) {
            const input = document.getElementById(inputId);
            const contador = document.getElementById(contadorId);
            const restante = maxLength - input.value.length;

            if (restante < 0) {
                contador.style.color = 'red';
                contador.textContent = `Te has pasado por ${Math.abs(restante)} caracteres`;
            } else {
                contador.style.color = '#666';
                contador.textContent = `Quedan ${restante} caracteres`;
            }
        }

        // Inicializar el contador al cargar la página
        document.addEventListener('DOMContentLoaded', () => {
            actualizarContador('nombre', 'contadorNombre', 45);
        });
    </script>




    <!--Mostrar mas de descripcion-->
    <script>
        // Mostrar contenido (nombre o descripción)
        function mostrarDescripcion(elemento) {
            const texto = elemento.getAttribute('data-texto');
            document.getElementById('descripcionCompleta').innerText = texto;
            document.getElementById('modalDescripcion').style.display = 'block';
        }

        // Cerrar el modal
        function cerrarDescripcion() {
            document.getElementById('modalDescripcion').style.display = 'none';
        }

        // Cierre al hacer clic fuera del modal
        window.onclick = function(event) {
            const modal = document.getElementById('modalDescripcion');
            if (event.target === modal) {
                cerrarDescripcion();
            }
        };
    </script>


    <!--Sidebar para movil-->
    <div id="overlay" class="overlay"></div>
    <script>
        const btnToggle = document.getElementById('btnToggleSidebar');
        const sidebar = document.querySelector('.sidebar');
        const overlay = document.getElementById('overlay');

        btnToggle.addEventListener('click', () => {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('active');

            // Ocultar o mostrar botón según estado del sidebar
            if (sidebar.classList.contains('open')) {
                btnToggle.style.display = 'none';
            } else {
                btnToggle.style.display = 'block';
            }
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.remove('open');
            overlay.classList.remove('active');
            btnToggle.style.display = 'block'; // Mostrar botón cuando sidebar se cierra al hacer click fuera
        });
    </script>






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

              $('.id_producto').select2({
                placeholder: 'Selecciona un producto',
                allowClear: true
            });
            
            $('#tablaUsuarios').DataTable({
                dom: 'Bfrtip',
                //Botones de acciones de la tabla
                buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="fas fa-copy"></i> Copiar'
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i> Excel'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i> PDF'
                    },

                ],

                pageLength: 5, // Fija la cantidad de registros a  mostrar
                lengthMenu: [5, 10, 25, 50, 100],
                responsive: true,
                language: {
                    search: "Buscar:",
                    lengthMenu: "Mostrar _MENU_ registros por página",
                    zeroRecords: "No se encontraron resultados",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                    infoEmpty: "Mostrando 0 a 0 de 0 entradas",
                    infoFiltered: "(filtrado de _MAX_ registros totales)",
                    paginate: {
                        first: "Primero",
                        previous: "Anterior",
                        next: "Siguiente",
                        last: "Último"
                    },
                    buttons: {
                        copyTitle: 'Copiado al portapapeles',
                        copySuccess: {
                            _: '%d filas copiadas',
                            1: '1 fila copiada'
                        },
                        copy: 'Copiar',
                        excel: 'Exportar a Excel',
                        pdf: 'Exportar a PDF'
                    }
                }

            });

        });
    </script>

    

</body>

</html>