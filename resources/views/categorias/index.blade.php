<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    @extends('dashboard.index')
    <title>Categorías</title>
    <link rel="stylesheet" href="{{ asset('css/categoriasEstilos/indexCategorias.css') }}"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  


    <link rel="stylesheet" href="styles.css" />
    <script src="script.js"></script>
  


    </head>

    <body>
    @section('contenido')
    <h2>CATEGORÍAS</h2>
 
    <a href="{{ route('categorias.create') }}" style="text-decoration:none;">
    <button class="btnAgregar">+Categoría</button>
    </a>
    
    <div class="table-container">
    
    
    
    <table id="tablaUsuarios" class="display nowrap" >
        <thead>
        <tr>
            <th>Codigo</th>
            <th class="nombre">Nombre</th>
            <th>Descripcion</th>
            <th>Acciones</th>
          
            
        </tr>
        </thead>
        <tbody>
        @foreach($categorias as $categoria)
        <tr>
            <td>{{ $categoria->id }}</td>
            <td>{{ $categoria->nombre }}</td>

            <td>

            <!-- Solo mostrara 30 carateres en la tabla -->

            <span class="descripcion-corta">
                {{ \Illuminate\Support\Str::limit($categoria->descripcion, 25, '...') }}
                @if(strlen($categoria->descripcion) > 25)
                    <i class="fa-solid fa-eye icono-ojo" onclick="mostrarDescripcion(this)" data-texto="{{ $categoria->descripcion }}"></i>
                @endif
            </span>
        </td>

            {{-- Acciones --}}
         <td>
                         <!-- Botón Editar -->
                <div class="flex flex-col justify-center items-center gap-2">
                <form  method="GET">
                        @csrf
                        <a  href="{{ route('categorias.edit', $categoria->id) }}" class="btnEditar" >
                            <i class="fa-regular fa-pen-to-square fa-lg" style="color:rgb(255, 255, 255);"></i>
                        </a>
                    </form>

                    <!-- Botón Eliminar -->
                    <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" style="display:inline;">
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
        
        <!-- Puedes agregar más filas -->
        </tbody>
    </table>
    </div>
    

<!--Mostrar mas de descripcion-->
    <script>
    function mostrarDescripcion(icon) {
        const descripcion = icon.getAttribute('data-completa');
        document.getElementById('descripcionCompleta').innerText = descripcion;
        document.getElementById('modalDescripcion').style.display = 'block';
    }

    function cerrarDescripcion() {
        document.getElementById('modalDescripcion').style.display = 'none';
    }

    window.onclick = function(event) {
        const modal = document.getElementById('modalDescripcion');
        if (event.target === modal) {
            cerrarDescripcion();
        }
    };
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
        confirmButtonColor: ' #09b410', 
    });
</script>
@endif
    </body>

    @endsection
    </html>