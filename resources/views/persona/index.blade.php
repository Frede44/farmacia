<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @extends('dashboard.index')
    <title>Personas</title>
    <link rel="stylesheet" href="{{ asset('css/personasEstilos/index.css') }}">
 <link rel="icon" href="{{ asset('img/LocoFarmacia.png') }}" type="image/png">
    <link rel="stylesheet" href="styles.css" />
    <script src="script.js"></script>




</head>



<body>
    @section('contenido')
    <h2>PERSONAS</h2>

    <div class="btn_div">
        <a href="{{ route('persona.create') }}" style="text-decoration: none;">
            <button class="btnAgregar">+Persona</button>
        </a>
    </div>

    <div class="table-container">



        <table id="tablaUsuarios" class="display nowrap">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>DPI</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Acciones</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($personas as $persona)
                <tr>

                    <td>{{ $persona->id }}</td>
                    <td>{{ $persona->nombre }}</td>
                    <td>{{ $persona->dpi }}</td>
                    <td>{{ $persona->correo }}</td>
                    <td>{{ $persona->telefono }}</td>
                    <td>{{ $persona->direccion }}</td>
                    <td>
                        <!-- Botón Editar -->
                        <div class="flex flex-col justify-center items-center gap-2">
                            <form method="GET">
                                @csrf
                                <a href="{{ route('persona.edit', $persona->id) }}" class="btnEditar">
                                    <i class="fa-regular fa-pen-to-square fa-lg" style="color:rgb(255, 255, 255);"></i>
                                </a>
                            </form>

                            <!-- Botón Eliminar -->
                            <form action="{{route('persona.destroy',$persona->id)}}" method="POST" style="display:inline;">
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