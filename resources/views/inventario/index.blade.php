<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Meta tags para configurar charset y responsive design -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Extendemos la vista del dashboard -->
    @extends('dashboard.index')

    <!-- Título de la página -->
    <title>Inventario</title>

    <!-- Enlaces a los archivos CSS -->
    <link rel="stylesheet" href="{{ asset('css/productosEstilos/indexProductos.css') }}">
    <link rel="stylesheet" href="styles.css" />

    <!-- Enlace al archivo JavaScript -->
    <script src="script.js"></script>
</head>

<body>
    <!-- Sección de contenido de la página -->
    @section('contenido')
    <div class="container">

        <!-- Título principal -->
        <h2>INVENTARIO</h2>

        <!-- Botón para agregar una nueva categoría -->
        <a href="{{ route('inventario.create') }}">
            <button class="btnAgregar">+Producto</button>
        </a>

        <!-- Contenedor de la tabla de inventario -->
        <div class="table-container">
            <table id="tablaUsuarios" class="display nowrap">
                <thead>
                    <tr>
                        <!-- Encabezados de la tabla -->
                      
                        
                        <th class="nombre">Nombre</th>
                        <th>Precio por unidad</th>
                        <th>Precio por caja</th>
                        <th>No. de cajas</th>
                        <th>No. de unidades</th>
                        <th>Fecha de caducidad</th>
                        <th>Acciones</th>

                    </tr>
                </thead>
                <tbody>
                    <!-- Iteración de los productos en el inventario -->
                    @foreach($inventarios as $inventario)
                    <tr>
                        
                        <td>{{ $inventario->producto->nombre }}</td>
                        <td>{{ $inventario->xunidad }}</td>
                        <td>{{ $inventario->xcaja }}</td>
                        <td>{{ $inventario->cantidad_caja }}</td>
                        <td>{{ $inventario->total_unidad }}</td>
                        <td>{{ $inventario->caducidad }}</td>


                        {{-- Acciones --}}
         <td>
                         <!-- Botón Editar -->
                <div class="flex flex-col justify-center items-center gap-2">
                <form  method="GET">
                        @csrf
                        <a  class="btnEditar" href="{{ route('inventario.edit', $inventario->id) }}" >
                            <i class="fa-regular fa-pen-to-square fa-lg" style="color:rgb(255, 255, 255);"></i>
                        </a>
                    </form>

                    <!-- Botón Eliminar -->
                    <form action="{{ route('inventario.destroy', $inventario->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <a href="#" class="btnEliminar" onclick="confirmarEliminacion(event, this)">
                        <i class="fa-regular fa-trash-can fa-xl" style="color:rgb(255, 255, 255);"></i>
                    </a>
                </form>
                </div>
        </td>
                    
                    </tr>
                    @endforeach
            
                    
                </tbody>
            </table>
        </div>

    </div>
    @endsection
</body>

</html>