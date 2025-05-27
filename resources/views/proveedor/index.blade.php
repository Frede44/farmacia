<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Meta tags para configurar charset y responsive design -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Extendemos la vista del dashboard -->
    @extends('dashboard.index')

    <!-- Título de la página -->
    <title>Proveedor</title>

    <!-- Enlaces a los archivos CSS -->
    <link rel="stylesheet" href="{{ asset('css/proveedorEstilos/indexProveedor.css') }}">
    <link rel="stylesheet" href="styles.css" />

    <!-- Enlace al archivo JavaScript -->
    <script src="script.js"></script>
</head>

<body>
    <!-- Sección de contenido de la página -->
    @section('contenido')
    <div class="container">

        <!-- Título principal -->
        <h2>PROVEEDOR</h2>

        <!-- Botón para agregar una nueva categoría -->
        <div class="btn_div">
            <a href="{{ route('proveedor.create') }}" style="text-decoration:none;">
                <button class="btnAgregar">+Proveedor</button>
            </a>
        </div>

        <!-- Contenedor de la tabla de inventario -->
        <div class="table-container">
            <table id="tablaUsuarios" class="display nowrap">
                <thead>
                    <tr>
                        <!-- Encabezados de la tabla -->
                      
                        
                        <th class="nombre">Nombre</th>
                        <th>Numero de Teléfono</th>
                        <th>Correo Electronico</th>
                        <th>Descripción</th>
                        <th>Acciones</th>

                    </tr>
                </thead>
                <tbody>
                    <!-- Iteración de los productos en el inventario -->
                    @foreach($proveedores as $proveedor)
                    <tr>
                        
                    <td>
            <span class="nombre-corto">
                {{ \Illuminate\Support\Str::limit($proveedor->nombre, 25, '...') }}
                @if(strlen($proveedor->nombre) > 25)
                    <i class="fa-solid fa-eye icono-ojo" onclick="mostrarDescripcion(this)" data-texto="{{ $proveedor->nombre }}"></i>
                @endif
            </span>
        </td>
                        <td>{{ $proveedor->numero_telefono }}</td>
                        <td>{{ $proveedor->correo }}</td>
                        <td><!-- Solo mostrara 30 carateres en la tabla -->
                <span class="descripcion-corta">
                {{ \Illuminate\Support\Str::limit($proveedor->descripcion, 15, '...') }}
                <!-- depues de los 30 mostrara el ojo -->
                    @if(strlen($proveedor->descripcion) > 15)
                        <i class="fa-solid fa-eye icono-ojo" onclick="mostrarDescripcion(this)" data-completa="{{ $proveedor->descripcion }}"></i>
                    @endif
                </span></td>
                


                        {{-- Acciones --}}
         <td>
                         <!-- Botón Editar -->
                <div class="flex flex-col justify-center items-center gap-2">
                <form  method="GET">
                        @csrf
                        <a  class="btnEditar" href="{{route('proveedor.edit', $proveedor->id) }}" >
                            <i class="fa-regular fa-pen-to-square fa-lg" style="color:rgb(255, 255, 255);"></i>
                        </a>
                    </form>

                    <!-- Botón Eliminar -->
                    <form action="{{route('proveedor.destroy', $proveedor->id)}}" method="POST" style="display:inline;">
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
                                 <!-- Modal para mostrar descripción completa -->
<div id="modalDescripcion" class="modal-descripcion" style="display:none;">
    <div class="modal-contenido">
        <span class="cerrar-modal" onclick="cerrarDescripcion()">&times;</span>
        <p id="descripcionCompleta"></p>
    </div>
</div>
            
                    
                </tbody>
            </table>
        </div>

    </div>
    @endsection
</body>

</html>