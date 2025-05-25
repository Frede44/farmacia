<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    @extends('dashboard.index')
    <title>Categorías</title>
    <link rel="stylesheet" href="{{ asset('css/productosEstilos/indexProductos.css') }}"> 
  


    <link rel="stylesheet" href="styles.css" />
    <script src="script.js"></script>
  


    </head>

    <body>
    @section('contenido')
    <h2>CATEGORÍAS</h2>
 
    <a href="{{ route('categorias.create') }}" style="text-decoration: none;">
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
            <td>{{ $categoria->descripcion }}</td>
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
       
       
    
        
        <!-- Puedes agregar más filas -->
        </tbody>
    </table>
    </div>
    

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