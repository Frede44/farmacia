<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @extends('dashboard.index')
    <title>Roles</title>
    <link rel="icon" type="image/png" href="{{ asset('img/pestaña.png') }}">
    <link rel="stylesheet" href="{{ asset('css/rolesEstilos/indexRoles.css') }}"> 
    <link rel="stylesheet" href="styles.css" />
    <script src="script.js"></script>



</head>



<body>
    @section('contenido')
    <h2>ROLES</h2>

    
    <div class="btn_div">
    <a href="{{ route('rol.create') }}" style="text-decoration:none;">
    <button class="btnAgregar">+Rol</button>
    </a>
    </div>


    <div class="table-container">
    
    
    
    <table id="tablaUsuarios" class="display nowrap" >
        <thead>
        <tr>
            <th>Código</th>
            <th class="nombre">Nombre</th>
            <th class="acciones">Acciones</th>
          
            
        </tr>
        </thead>
        <tbody>
        
        @foreach ($role as $rol)
        <tr>
            <td>{{ $rol->id }}</td>
            <td>{{ $rol->name }}</td>
            
            {{-- Acciones --}}
         <td>
                         <!-- Botón Editar -->
                <div class="flex flex-col justify-center items-center gap-2">
                <form  method="GET">
                        @csrf
                        <a  class="btnEditar" href="{{route('rol.edit', $rol->id) }}" >
                            <i class="fa-regular fa-pen-to-square fa-lg" style="color:rgb(255, 255, 255);"></i>
                        </a>
                    </form>

                    <!-- Botón Eliminar -->
                    <form action="{{route('rol.destroy', $rol->id)}}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <a href="#" class="btnEliminar" onclick="confirmarEliminacion(event, this)">
                        <i class="fa-regular fa-trash-can fa-xl" style="color:rgb(255, 255, 255);"></i>
                    </a>
                </form>
                </div>
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




    @endsection

</html>