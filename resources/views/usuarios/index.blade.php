<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @extends('dashboard.index')
    <title>Usuarios</title>
    <link rel="stylesheet" href="{{ asset('css/productosEstilos/indexProductos.css') }}">



    <link rel="stylesheet" href="styles.css" />
    <script src="script.js"></script>




</head>



<body>
    @section('contenido')
    <h2>USUARIOS</h2>

    <div class="btn_div">
        <a href="{{ route('register.index') }}" style="text-decoration:none;">
        <button class="btnAgregar">+Usuario</button>
    </a>
    </div>

    <div class="table-container">



        <table id="tablaUsuarios" class="display nowrap">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>nombre</th>
                    <th>correo</th>
                    <th>roles</th>
                    <th>Acciones</th>


                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>

                    <td>
                        @foreach ($user->roles as $role)
                        {{ $role->name }}
                        @endforeach
                    </td>
                    <td>
                        <!-- Botón Editar -->
                        <div class="flex flex-col justify-center items-center gap-2">
                            <form method="GET">
                                @csrf
                                <a href="{{ route('usuarios.edit', $user->id) }}" class="btnEditar">
                                    <i class="fa-regular fa-pen-to-square fa-lg" style="color:rgb(255, 255, 255);"></i>
                                </a>
                            </form>

                            <!-- Botón Eliminar -->
                            <form action="{{route('usuarios.destroy',$user->id)}}" method="POST" style="display:inline;">
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



</body>

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