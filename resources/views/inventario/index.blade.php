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
<link rel="icon" type="image/png" href="{{ asset('img/pestaña.png') }}">
    <!-- Enlaces a los archivos CSS -->
    <link rel="stylesheet" href="{{ asset('css/inventarioEstilos/indexInventario.css') }}">
    <link rel="stylesheet" href="styles.css" />
     <link rel="icon" href="{{ asset('img/LocoFarmacia.png') }}" type="image/png">

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
        <div class="btn_div">
        <a href="{{ route('inventario.create') }}" style="text-decoration:none;">
            <button class="btnAgregar">+Producto</button>
        </a>
        </div>

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
                        <th>Unidades totales</th>
                        <th>Fecha de caducidad</th>
                        <th>Acciones</th>

                    </tr>
                </thead>
                <tbody>
                    <!-- Iteración de los productos en el inventario -->
         @foreach($inventarios as $inventario)
                    <tr>
                @if($inventario)
                    <td>
                        @if($inventario->producto)
                             <span class="nombre-corto">
                            {{ \Illuminate\Support\Str::limit($inventario->producto->nombre, 25, '...' ?? 'Sin nombre') }}
                            @if(strlen($inventario->producto->nombre) > 25)
                                <i class="fa-solid fa-eye icono-ojo" onclick="mostrarDescripcion(this)" data-texto="{{ $inventario->producto->nombre }}"></i>
                            @endif
                             </span>

                         @else
                            <span class="nombre-corto">Sin Producto</span>
                        @endif

                    </td>
                        <td>{{ $inventario->xunidad  ?? 'Sin Unidad' }}</td>
                        <td>{{ $inventario->xcaja  ?? 'Sin Caja' }}</td>
                        <td>{{ $inventario->cantidad_caja  ?? 'Sin Caja' }}</td>
                        <td>{{ $inventario->unidad_caja  ?? 'Sin Unidad' }}</td>
                        <td>{{ $inventario->total_unidad  ?? 'Sin Unidad' }}</td>

                        <td>
                        @if($inventario->diferenciaDias < 0)
                            <span style="color:rgb(231, 25, 45); font-weight: bold;">
                                {{ $inventario->fechaCaducidadObj->format('d/m/Y') }} (Caducado)
                            </span>
                        @elseif($inventario->diferenciaDias <= 150) <!--5 meses -->
                            <span style="color:rgb(238, 127, 0); font-weight: bold;">
                                {{ $inventario->fechaCaducidadObj->format('d/m/Y') }} (Próximo a caducar)
                            </span>
                        @else
                            <span style="color:rgb(57, 206, 37); font-weight: bold;">
                                {{ $inventario->fechaCaducidadObj->format('d/m/Y') }} (Vigente)
                            </span>
                        @endif
                    </td>
                @endif


                        


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
                    <!-- Modal para mostrar la descripción completa (se reutiliza para nombre también) -->
            <div id="modalDescripcion" class="modal-descripcion" style="display:none;">
                <div class="modal-contenido">
                    <span class="cerrar-modal" onclick="cerrarDescripcion()">&times;</span>
                    <p id="descripcionCompleta"></p>
                </div>
            </div>

        @endforeach
                    
               
                </tbody>
            </table>
        </div>

    </div>
    @endsection
</body>

</html>