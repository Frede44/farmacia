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
 
    <a href="{{ route('categorias.create') }}">
    <button class="btnAgregar">+Categoría</button>
    </a>
    
    <div class="table-container">
    
    
    
    <table id="tablaUsuarios" class="display nowrap" >
        <thead>
        <tr>
            <th>Codigo</th>
            <th class="nombre">Nombre</th>
            <th>Descripcion</th>
          
            
        </tr>
        </thead>
        <tbody>
        @foreach($categorias as $categoria)
        <tr>
            <td>{{ $categoria->id }}</td>
            <td>{{ $categoria->nombre }}</td>
            <td>{{ $categoria->descripcion }}</td>
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