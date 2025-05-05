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
    <h2>PRODUCTOS</h2>

    <a href="{{ route('persona.create') }}">
        <button class="btnAgregar">crear personas</button>
    </a>

    <div class="table-container">



        <table id="tablaUsuarios" class="display nowrap">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>nombre</th>
                    <th>DPI</th>
                    <th>correo</th>
                    <th>telefono</th>
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
                    <td>
                        <a href="{{ route('persona.edit', $persona->id) }}" class="btnEditar"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('persona.destroy', $persona->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btnEliminar"><i class="fas fa-trash-alt"></i></button>
                        </form>

                    </td>
                </tr>

                @endforeach



                <!-- Puedes agregar más filas -->
            </tbody>
        </table>
    </div>

</body>

@endsection

</html>