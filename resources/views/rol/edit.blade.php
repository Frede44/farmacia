<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @extends('dashboard.index')
    <title>Roles</title>
    <link rel="stylesheet" href="{{ asset('css/productosEstilos/indexProductos.css') }}">
    <!-- Iconos-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">


    <link rel="stylesheet" href="{{asset('css/rolesEstilos/rolesEstilo.css')}}" />
    <script src="script.js"></script>




</head>



<body>
    @section('contenido')
    <h2>Crear roles</h2>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div class="table-container">


        <form action="{{ route('rol.update', $rol) }}" method="POST">
            <!-- Cambia el método a PUT para actualizar el rol -->
       
            @csrf
            @method('PUT')
            <div class="form-group">
                <div class="input-name">
                    <label for="id_rol">Nombre del rol:</label>
                    <input type="text" name="name" id="nombre_rol" placeholder="Nombre del rol" required value="{{ $rol->name }}">
                </div>

                <!-- <div class="checkbox-group">
                    <h2>permisos</h2>
                    <div class="permisos-group">
                        <p class="nombre_permiso">usuarios</p>
                        <div class="Checkbox-group-permisos">
                            <input type="checkbox" name="permisos[]" id="usuarios.create" value="[usuarios.create, usuarios.store]">
                            <label for="permiso1">Crear</label><br>
                        </div>
                        <div class="Checkbox-group-permisos">

                            <input type="checkbox" name="permisos[]" id="permiso2" value="usuarios.edit">
                            <label for="permiso2">Modificar</label><br>
                        </div>
                        <div class="Checkbox-group-permisos">
                            <input type="checkbox" name="permisos[]" id="permiso3" value="usuarios.destroy">
                            <label for="permiso2">eliminar</label><br>
                        </div>
                        <div class="Checkbox-group-permisos">
                            <input type="checkbox" name="permisos[]" id="permiso4" value="usuarios.index">
                            <label for="permiso4">Consultar</label><br>
                        </div>

                    </div> -->

                @foreach($permissions as $grupo => $permisos)
                <div class="permisos-group">
                    <p class="nombre_permiso">{{ ucfirst($grupo) }}</p>
                    <div class="Checkbox-group-permisos">
                        @foreach($permisos as $permiso)
                        <div class="Checkbox-group-permisos">
                            <input type="checkbox" name="permissions[]" id="{{ $permiso->name }}" value="{{ $permiso->name }}"
                                {{ in_array($permiso->name, $rolePermissions) ? 'checked' : '' }}>
                            <label for="{{ $permiso->name }}">{{ $permiso->descripcion }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach

            </div>

            <button type="submit">Crear</button>

        </form>

    </div>



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

@endsection

</html>