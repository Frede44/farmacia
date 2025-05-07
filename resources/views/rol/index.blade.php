<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    @extends('dashboard.index')
    <title>Productos</title>
    <link rel="stylesheet" href="{{ asset('css/productosEstilos/indexProductos.css') }}"> 
    <link rel="stylesheet" href="styles.css" />
    <script src="script.js"></script>



    </head>



    <body>
    @section('contenido')
    <h2>ROLES</h2>

    
  
    <a href="{{ route('rol.create') }}">
    <button class="btnAgregar">Crear roles</button>
    </a>

 
    <div class="table-container">
    
    
    
    <table id="tablaUsuarios" class="display nowrap" >
        <thead>
        <tr>
            <th>Codigo</th>
            <th class="nombre">nombre</th>
            <th class="acciones">Acciones</th>
          
            
        </tr>
        </thead>
        <tbody>
        
        @foreach ($role as $rol)
        <tr>
            <td>{{ $rol->id }}</td>
            <td>{{ $rol->name }}</td>
            
            <td class="acciones">
                <a href="{{ route('rol.edit', $rol->id) }}" class="btnEditar"><i class="fas fa-edit"></i></a>
                <form action="{{ route('rol.destroy', $rol) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btnEliminar"><i class="fas fa-trash"></i></button>
                </form>
            </td>
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
    

  

    @endsection
    </html>